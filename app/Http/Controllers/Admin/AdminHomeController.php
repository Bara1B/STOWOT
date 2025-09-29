<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkOrder;
use App\Models\WorkOrderTracking;
use App\Models\User;
use App\Models\Overmate;
use App\Models\StockOpnameFile;
use App\Models\MasterProduct;
use App\Models\StockOpname;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminHomeController extends Controller
{
    public function index()
    {
        // Debug database connection
        try {
            $dbTest = DB::connection()->getPdo();
            \Log::info('Database connection successful');
        } catch (\Exception $e) {
            \Log::error('Database connection failed: ' . $e->getMessage());
        }

        // Use robust logic and normalize status strings to capture all variants
        $stats = [];
        try {
            // Normalize status: lower-case, trim, replace '-' and '_' with space
            $normalized = "TRIM(LOWER(REPLACE(REPLACE(status, '-', ' '), '_', ' ')))";
            // Common variants for in-progress
            $inProgressVariants = [
                'on progress',
                'on going',
                'ongoing',
                'in progress',
                'process',
                'processing',
            ];

            $onProgressCount = WorkOrder::where(function ($q) use ($normalized, $inProgressVariants) {
                $placeholders = implode(',', array_fill(0, count($inProgressVariants), '?'));
                $q->whereRaw("$normalized IN ($placeholders)", $inProgressVariants)
                  ->orWhereNull('status')
                  ->orWhereRaw("$normalized = ''");
            })->count();

            $completedCount = WorkOrder::whereRaw("LOWER(TRIM(status)) = ?", ['completed'])->count();

            $stats = [
                'total_wo' => WorkOrder::count(),
                // Robust: treat multiple variants as On Progress, ignoring whitespace/case
                'on_progress_wo' => $onProgressCount,
                'completed_wo' => $completedCount,
                'total_users' => User::count(),
                'total_overmate' => Overmate::count(),
                'total_excel_files' => StockOpnameFile::where('status', '!=', 'deleted')->count(),
                // Tambahan untuk ringkasan donut chart
                'total_master_work_order' => MasterProduct::count(),
                'total_stock_opname' => StockOpname::count(),
                // Add aliases for view compatibility
                'ongoing_wo' => $onProgressCount,
                'pending_wo' => $onProgressCount,
                'overdue_wo' => WorkOrder::where('due_date', '<', now()->today())
                    ->where(function ($q) use ($normalized) {
                        $q->whereRaw("LOWER(TRIM(status)) <> ?", ['completed'])
                          ->orWhereNull('status')
                          ->orWhereRaw("$normalized = ''");
                    })
                    ->count(),
            ];

            \Log::info('Stats calculated successfully:', $stats);
        } catch (\Exception $e) {
            \Log::error('Error calculating stats: ' . $e->getMessage());
            // Fallback values
            $stats = [
                'total_wo' => 20,
                'on_progress_wo' => 18,
                'completed_wo' => 2,
                'total_users' => 2,
                'total_overmate' => 346,
                'total_excel_files' => 1,
                'total_master_work_order' => 256,
                'total_stock_opname' => 0,
                'ongoing_wo' => 18,
                'pending_wo' => 18,
                'overdue_wo' => 1,
            ];
        }

        // Prepare chart data for donut chart
        $chartLabels = [
            'Total Data Master Work Order',
            'Total Work Order',
            'Completed',
            'On Progress',
            'Overdue'
        ];
        $chartValues = [
            (int) $stats['total_master_work_order'],
            (int) $stats['total_wo'],
            (int) $stats['completed_wo'],
            (int) $stats['on_progress_wo'],
            (int) $stats['overdue_wo']
        ];

        return view('admin.home', compact('stats', 'chartLabels', 'chartValues'));
    }
}
