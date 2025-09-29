<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WorkOrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\Admin\StockOpnameController;
use App\Http\Controllers\Admin\OvermateController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\DevController;
use App\Http\Controllers\Api\WorkOrderStatusController;

// Halaman utama & Auth
Route::get('/', [App\Http\Controllers\PublicHomeController::class, 'index'])->name('public.home');
Route::get('/public/work-orders', [App\Http\Controllers\PublicHomeController::class, 'workOrders'])->name('public.work-orders');
Route::get('/public/tracking/{workOrder}', [App\Http\Controllers\PublicHomeController::class, 'showTracking'])->name('public.tracking');

Auth::routes();

// Route untuk download template (bisa diakses tanpa login)
Route::get('/stock-opname/download-template', [StockOpnameController::class, 'downloadTemplate'])->name('stock-opname.download-template');

// ===================================================================
// GRUP UNTUK SEMUA USER YANG SUDAH LOGIN (ADMIN & USER BIASA)
// ===================================================================
Route::middleware(['auth'])->group(function () {
    // Rute yang bisa diakses SEMUA user
    // Rute dashboard sekarang jadi lebih dinamis
    Route::get('/workorder-dashboard/{status?}', [DashboardController::class, 'index'])->name('workorderdashboard');
    // Backward compatibility: redirect /dashboard ke rute baru
    Route::get('/dashboard/{status?}', function ($status = null) {
        return redirect()->route('workorderdashboard', ['status' => $status]);
    })->name('dashboard');

    Route::get('/work-order/{workOrder}', [WorkOrderController::class, 'show'])->name('work-order.show');

    // API Routes (buat form cerdas)
    Route::get('/api/product/{kode}', [ProductApiController::class, 'getProductDetail']);
    Route::get('/api/product/{kode}/next-sequence', [ProductApiController::class, 'getNextSequence']);

    // Route buat export Excel
    Route::get('/work-orders/export', [DashboardController::class, 'export'])->name('work-orders.export');

    // Rute buat update due date borongan
    Route::put('/work-orders/bulk-update-due-date', [WorkOrderController::class, 'bulkUpdateDueDate'])->name('work-orders.bulk-update-due-date');

    // Stock Opname Routes (User - View Only)
    Route::get('/stock-opname', [App\Http\Controllers\StockOpnameController::class, 'index'])->name('stock-opname.index');
    Route::get('/stock-opname/data/{fileId}', [App\Http\Controllers\StockOpnameController::class, 'showData'])->name('stock-opname.show-data');
    Route::get('/stock-opname/export/{fileId}', [App\Http\Controllers\StockOpnameController::class, 'exportData'])->name('stock-opname.export-data');

    // Overmate Routes (Public - accessible to all authenticated users)
    Route::get('/overmate', [OvermateController::class, 'index'])->name('overmate.index');

    // Home route - redirect based on user role
    Route::get('/home', function () {
        $user = Auth::user();

        if ($user && $user->role === 'admin') {
            return redirect()->route('admin.home');
        }
        return redirect()->route('public.home');
    })->name('home');

    Route::get('/user/home', function () {
        return redirect()->route('public.home');
    })->name('user.home');

    Route::put('/work-orders/tracking/{tracking}/update-date', [WorkOrderController::class, 'updateTrackingDate'])->name('work-orders.tracking.update-date');

    Route::post('/work-orders/tracking/{tracking}/complete', [WorkOrderController::class, 'completeStep'])->name('work-orders.tracking.complete');

    // API Routes for selective DOM updates
    Route::get('/api/work-orders/{workOrder}/status', [WorkOrderStatusController::class, 'getStatus'])->name('api.work-orders.status');
    Route::get('/api/work-orders/{workOrder}/status/{status}', [WorkOrderStatusController::class, 'getStatusById'])->name('api.work-orders.status-by-id');
});

// ===================================================================
// GRUP UNTUK RUTE KHUSUS ADMIN
// ===================================================================
Route::middleware(['auth', 'admin'])->group(function () {
    // User Management - Removed standalone users route, now handled in settings

    // Work Order Management (Create, Update, Delete)
    Route::get('/work-orders/create', [WorkOrderController::class, 'create'])->name('work-orders.create');
    Route::post('/work-orders', [WorkOrderController::class, 'store'])->name('work-orders.store');
    Route::get('/work-orders/{workOrder}/edit', [WorkOrderController::class, 'edit'])->name('work-orders.edit');
    Route::put('/work-orders/{workOrder}', [WorkOrderController::class, 'update'])->name('work-orders.update');
    Route::delete('/work-orders/{workOrder}', [WorkOrderController::class, 'destroy'])->name('work-orders.destroy');

    // Rute buat nampilin form tambah borongan
    Route::get('/work-orders/bulk-create', [WorkOrderController::class, 'bulkCreate'])->name('work-orders.bulk-create');

    // Rute buat ngeproses form-nya
    Route::post('/work-orders/bulk-store', [WorkOrderController::class, 'bulkStore'])->name('work-orders.bulk-store');

    // Aksi-aksi lain yang butuh admin
    Route::post('/work-order/{workOrder}/products', [ProductController::class, 'store'])->name('work-order.products.store');

    // Rute buat hapus borongan
    Route::delete('/work-orders', [WorkOrderController::class, 'bulkDestroy'])->name('work-orders.bulk-destroy');

    Route::get('/api/charts/monthly-wo', [ChartController::class, 'monthlyWorkOrders'])->name('charts.monthly-wo');

    // Admin Home
    Route::get('/admin/home', [App\Http\Controllers\Admin\AdminHomeController::class, 'index'])->name('admin.home');

    // Data Master Hub
    Route::get('/data-master', function () {
        return view('admin.data_master');
    })->name('admin.data-master');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings.index');
    Route::get('/settings/wo', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings/wo', [SettingController::class, 'update'])->name('settings.update');
    Route::delete('/settings/wo/reset', [SettingController::class, 'reset'])->name('settings.reset');

    // Overmate Master CRUD (Admin)
    Route::get('/overmate/create', [OvermateController::class, 'create'])->name('overmate.create');
    Route::post('/overmate', [OvermateController::class, 'store'])->name('overmate.store');
    // More specific routes must come BEFORE the general catch-all route
    Route::get('/overmate/{itemNumber}/edit', [OvermateController::class, 'editByItemNumber'])->name('overmate.edit');
    Route::put('/overmate/{itemNumber}', [OvermateController::class, 'updateByItemNumber'])->name('overmate.update');
    Route::delete('/overmate/{itemNumber}', [OvermateController::class, 'destroy'])->name('overmate.destroy');
    // General catch-all route for show (must come LAST)
    Route::get('/overmate/{itemNumber}', [OvermateController::class, 'show'])
        ->where('itemNumber', '^(?!create$).+')->name('overmate.show');

    Route::get('/work-orders/data', [\App\Http\Controllers\Admin\WorkOrderDataController::class, 'index'])->name('work-orders.data.index');
    Route::get('/work-orders/data/create', [\App\Http\Controllers\Admin\WorkOrderDataController::class, 'create'])->name('work-orders.data.create');
    Route::post('/work-orders/data', [\App\Http\Controllers\Admin\WorkOrderDataController::class, 'store'])->name('work-orders.data.store');
    Route::get('/work-orders/data/{product}/edit', [\App\Http\Controllers\Admin\WorkOrderDataController::class, 'edit'])->name('work-orders.data.edit');
    Route::put('/work-orders/data/{product}', [\App\Http\Controllers\Admin\WorkOrderDataController::class, 'update'])->name('work-orders.data.update');
    Route::delete('/work-orders/data/{product}', [\App\Http\Controllers\Admin\WorkOrderDataController::class, 'destroy'])->name('work-orders.data.destroy');
    Route::post('/work-orders/data/import', [\App\Http\Controllers\Admin\WorkOrderDataController::class, 'import'])->name('work-orders.data.import');
    // Admin Routes (Protected by admin middleware)
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        // Data Master Route
        Route::get('/data-master', function () {
            $stats = [
                'total_master_work_order' => \App\Models\MasterProduct::count(),
                'total_overmate' => \App\Models\Overmate::count(),
            ];
            return view('admin.data-master', compact('stats'));
        })->name('data-master');

        // Settings Routes
        Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::put('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
        Route::get('/settings/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('settings.users');
        Route::get('/settings/users/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('settings.users.create');
        Route::post('/settings/users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('settings.users.store');
        Route::get('/settings/users/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('settings.users.edit');
        Route::put('/settings/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('settings.users.update');
        Route::delete('/settings/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('settings.users.destroy');
        Route::get('/settings/edit', [\App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('settings.edit');
        Route::get('/settings/wo', [\App\Http\Controllers\Admin\SettingController::class, 'wo'])->name('settings.wo');

        // Stock Opname Admin Routes
        Route::get('/stock-opname', [App\Http\Controllers\Admin\StockOpnameController::class, 'index'])->name('stock-opname.index');
        Route::get('/stock-opname/data/{fileId}', [App\Http\Controllers\Admin\StockOpnameController::class, 'showData'])->name('stock-opname.show-data');
        Route::post('/stock-opname/upload', [App\Http\Controllers\Admin\StockOpnameController::class, 'import'])->name('stock-opname.upload');
        Route::post('/stock-opname/import/{fileId}', [App\Http\Controllers\Admin\StockOpnameController::class, 'importData'])->name('stock-opname.import-data');
        Route::post('/stock-opname/{fileId}/add-row', [App\Http\Controllers\Admin\StockOpnameController::class, 'addRow'])->name('stock-opname.add-row');
        Route::put('/stock-opname/update-stok/{id}', [App\Http\Controllers\Admin\StockOpnameController::class, 'updateStokFisik'])->name('stock-opname.update-stok');
        Route::put('/stock-opname/update-lot-serial/{id}', [App\Http\Controllers\Admin\StockOpnameController::class, 'updateLotSerial'])->name('stock-opname.update-lot-serial');
        Route::put('/stock-opname/update-keterangan/{id}', [App\Http\Controllers\Admin\StockOpnameController::class, 'updateKeterangan'])->name('stock-opname.update-keterangan');
        Route::put('/stock-opname/update-location-actual/{id}', [App\Http\Controllers\Admin\StockOpnameController::class, 'updateLocationActual'])->name('stock-opname.update-location-actual');
        Route::delete('/stock-opname/row/{id}', [App\Http\Controllers\Admin\StockOpnameController::class, 'destroyRow'])->name('stock-opname.row.destroy');
        Route::get('/stock-opname/history/{id}', [App\Http\Controllers\Admin\StockOpnameController::class, 'getHistory'])->name('stock-opname.history');
        Route::get('/stock-opname/export/{fileId}', [App\Http\Controllers\Admin\StockOpnameController::class, 'exportData'])->name('stock-opname.export-data');
        Route::delete('/stock-opname/{fileId}', [App\Http\Controllers\Admin\StockOpnameController::class, 'deleteFile'])->name('stock-opname.delete');
    });
});

// Hapus API dev auto refresh - gunakan Vite HMR
