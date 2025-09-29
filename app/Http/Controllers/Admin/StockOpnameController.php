<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StockOpname;
use App\Models\StockOpnameHistory;
use App\Models\Overmate;
use App\Models\StockOpnameFile;
use App\Imports\StockOpnameImport;
use App\Exports\StockOpnameTemplateExport;
use App\Exports\StockOpnameFilledExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Helpers\NotificationHelper;

class StockOpnameController extends Controller
{
    /**
     * Menampilkan halaman utama Stock Opname dengan list file yang sudah diupload.
     */
    public function index()
    {
        $uploadedFiles = StockOpnameFile::where('status', '!=', 'deleted')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.stock_opname.index', compact('uploadedFiles'));
    }

    /**
     * Tambah baris baru ke stock_opnames untuk file tertentu.
     */
    public function addRow(Request $request, $fileId)
    {
        $request->validate([
            'location_system' => 'required|string|max:100',
            'item_number' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
            'manufacturer' => 'nullable|string|max:255',
            'lot_serial' => 'nullable|string|max:100',
            'reference' => 'nullable|string|max:100',
            'unit_of_measure' => 'nullable|string|max:50',
            'quantity_on_hand' => 'required|numeric',
            'stok_fisik' => 'nullable|numeric',
            'expired_date' => 'nullable|date',
        ]);

        try {
            // pastikan file ada
            $file = StockOpnameFile::findOrFail($fileId);

            StockOpname::create([
                'file_id' => $file->id,
                'location_system' => $request->location_system,
                'item_number' => $request->item_number,
                'description' => $request->description,
                'manufacturer' => $request->manufacturer,
                'lot_serial' => $request->lot_serial,
                'reference' => $request->reference,
                'unit_of_measure' => $request->unit_of_measure,
                'quantity_on_hand' => $request->quantity_on_hand,
                'stok_fisik' => $request->stok_fisik,
                'expired_date' => $request->expired_date,
            ]);

            NotificationHelper::created('Baris stock opname');
            return redirect()->route('admin.stock-opname.show-data', $fileId);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambah baris: ' . $e->getMessage());
        }
    }

    /**
     * Update lot serial for a specific item.
     */
    public function updateLotSerial(Request $request, $id)
    {
        $request->validate([
            'lot_serial' => 'nullable|string|max:100',
        ]);

        try {
            $stockOpname = StockOpname::findOrFail($id);
            $old = $stockOpname->lot_serial;

            $stockOpname->update([
                'lot_serial' => $request->lot_serial,
            ]);

            // optional: record history if needed later
            // $this->createHistory($stockOpname, 'lot_serial', $old, $request->lot_serial, 'update');

            NotificationHelper::updated('Lot Serial');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan data stock opname untuk file tertentu.
     */
    public function showData($fileId)
    {
        $stockOpnameFile = StockOpnameFile::findOrFail($fileId);

        $stockOpnames = DB::table('stock_opnames as so')
            // Join Overmate Master by item_number + lot_serial (most accurate)
            ->leftJoin('overmate_masters as omm', function ($join) {
                $join->on('omm.item_number', '=', 'so.item_number')
                     ->on('omm.lot_serial', '=', 'so.lot_serial');
            })
            // Fallback join to overmate by item_number
            ->leftJoin('overmate as om', 'om.item_number', '=', 'so.item_number')
            ->select(
                'so.*',
                DB::raw('COALESCE(omm.overmate, om.overmate_qty) as overmate_value'),
                DB::raw('CAST(COALESCE(so.stok_fisik, 0) - COALESCE(so.quantity_on_hand, 0) AS DECIMAL(15,5)) as selisih'),
                DB::raw('CASE WHEN (COALESCE(so.stok_fisik, 0) - COALESCE(so.quantity_on_hand, 0)) > COALESCE(omm.overmate, om.overmate_qty, 0) THEN "Tidak" ELSE "Iya" END as masuk_kategori')
            )
            ->where('so.file_id', $fileId)
            ->orderBy('so.created_at', 'desc')
            ->paginate(15);

        return view('stock_opname.data', compact('stockOpnames', 'stockOpnameFile'));
    }

    /**
     * Menampilkan form upload Excel.
     */
    public function create()
    {
        // Upload form is integrated into the admin index page
        return redirect()->route('admin.stock-opname.index');
    }

    /**
     * Import data dari file Excel (.xlsx).
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:10240', // Max 10MB
        ]);

        try {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $filename = 'stock_opname_' . time() . '_' . $originalName;
            $filePath = $file->storeAs('stock_opname', $filename, 'public');

            // Save file record
            $stockOpnameFile = StockOpnameFile::create([
                'filename' => $filename,
                'original_name' => $originalName,
                'file_path' => $filePath,
                'file_size' => $file->getSize(),
                'uploaded_by' => Auth::id(),
                'status' => 'uploaded',
            ]);

            NotificationHelper::success('File Excel berhasil diupload! Silakan klik "Import Data" untuk memproses file.');
            return redirect()->route('admin.stock-opname.index');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat upload: ' . $e->getMessage());
        }
    }

    /**
     * Import data dari file yang sudah diupload.
     */
    public function importData($fileId)
    {
        try {
            $stockOpnameFile = StockOpnameFile::findOrFail($fileId);

            if ($stockOpnameFile->status !== 'uploaded') {
                return redirect()->route('admin.stock-opname.index')
                    ->with('error', 'File sudah diimport atau tidak valid.');
            }

            // Truncate existing data for this file
            StockOpname::where('file_id', $fileId)->delete();

            // Import data from stored file
            $filePath = storage_path('app/public/' . $stockOpnameFile->file_path);
            Excel::import(new StockOpnameImport($stockOpnameFile->id), $filePath);

            // Update file status
            $stockOpnameFile->update([
                'status' => 'imported',
                'imported_at' => now(),
            ]);

            NotificationHelper::imported('Data dari file: ' . $stockOpnameFile->original_name);
            return redirect()->route('admin.stock-opname.show-data', $fileId);
        } catch (\Exception $e) {
            return redirect()->route('admin.stock-opname.index')
                ->with('error', 'Terjadi kesalahan saat import: ' . $e->getMessage());
        }
    }

    /**
     * Update stok fisik untuk item tertentu.
     */
    public function updateStokFisik(Request $request, $id)
    {
        $request->validate([
            'stok_fisik' => 'required|numeric|min:0',
        ]);

        try {
            $stockOpname = StockOpname::findOrFail($id);
            $oldValue = $stockOpname->stok_fisik;
            
            $stockOpname->update([
                'stok_fisik' => $request->stok_fisik
            ]);

            // Create history record
            $this->createHistory($stockOpname, 'stok_fisik', $oldValue, $request->stok_fisik, 'update');

            NotificationHelper::updated('Stok fisik');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update keterangan untuk item tertentu.
     */
    public function updateKeterangan(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'nullable|string|max:1000',
        ]);

        try {
            $stockOpname = StockOpname::findOrFail($id);
            
            $stockOpname->update([
                'keterangan' => $request->keterangan
            ]);

            NotificationHelper::updated('Keterangan');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update location actual status untuk item tertentu.
     */
    public function updateLocationActual(Request $request, $id)
    {
        $request->validate([
            'location_actual_status' => 'required|in:centang,x',
            'location_actual_keterangan' => 'nullable|string|max:1000',
        ]);

        try {
            $stockOpname = StockOpname::findOrFail($id);
            
            $stockOpname->update([
                'location_actual_status' => $request->location_actual_status,
                'location_actual_keterangan' => $request->location_actual_status === 'x' ? $request->location_actual_keterangan : null
            ]);

            NotificationHelper::updated('Location Actual');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Create history record
     */
    private function createHistory($stockOpname, $fieldName, $oldValue, $newValue, $action)
    {
        if ($oldValue != $newValue) {
            StockOpnameHistory::create([
                'stock_opname_id' => $stockOpname->id,
                'user_id' => auth()->id(),
                'field_name' => $fieldName,
                'old_value' => $oldValue,
                'new_value' => $newValue,
                'action' => $action,
            ]);
        }
    }

    /**
     * Get history for specific item (hanya stok fisik)
     */
    public function getHistory($id)
    {
        $stockOpname = StockOpname::findOrFail($id);
        $histories = $stockOpname->histories()
            ->where('field_name', 'stok_fisik')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($histories);
    }

    /**
     * Download template Excel untuk Stock Opname.
     */
    public function downloadTemplate()
    {
        $fileName = 'Template_Stock_Opname_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new StockOpnameTemplateExport, $fileName);
    }

    /**
     * Export data stock opname yang sudah terisi sesuai template (filled).
     */
    public function exportData($fileId)
    {
        $stockOpnameFile = StockOpnameFile::findOrFail($fileId);

        $safeName = pathinfo($stockOpnameFile->original_name, PATHINFO_FILENAME);
        $fileName = 'Stock_Opname_Filled_' . $safeName . '_' . date('Y-m-d_H-i-s') . '.xlsx';

        return Excel::download(new StockOpnameFilledExport($fileId), $fileName);
    }

    /**
     * Hapus file stock opname.
     */
    public function deleteFile($fileId)
    {
        try {
            $stockOpnameFile = StockOpnameFile::findOrFail($fileId);

            // Hapus data stock opname yang terkait dengan file ini
            StockOpname::where('file_id', $fileId)->delete();

            // Hapus file fisik dari storage
            if (Storage::disk('public')->exists($stockOpnameFile->file_path)) {
                Storage::disk('public')->delete($stockOpnameFile->file_path);
            }

            // Hapus record file dari database
            $stockOpnameFile->delete();

            NotificationHelper::deleted('File: ' . $stockOpnameFile->original_name);
            return redirect()->route('admin.stock-opname.index');
        } catch (\Exception $e) {
            return redirect()->route('admin.stock-opname.index')
                ->with('error', 'Terjadi kesalahan saat hapus file: ' . $e->getMessage());
        }
    }
}
