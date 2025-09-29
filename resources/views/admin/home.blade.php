@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Selamat Datang, {{ Auth::user()->name }}!</h1>
        <p class="text-gray-600 mt-2">Monitor progress dan status terkini</p>
    </div>

    <!-- Main Cards Grid - Like Laravel 12 -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Work Order Tracking Card -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow cursor-pointer nav-card" 
             onclick="window.location.href='{{ route('dashboard') }}'">
            <div class="p-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h5 class="text-lg font-semibold text-blue-600 mb-2">Work Order Tracking</h5>
                        <p class="text-gray-600 text-sm mb-4">
                            Kelola dan pantau semua work order mulai dari pembuatan hingga penyelesaian. Lacak status progres setiap tahapan produksi.
                        </p>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Kelola Work Order
                        </button>
                    </div>
                    <div class="text-blue-600 ml-4">
                        <i class="fas fa-clipboard-list text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stock Opname Card -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow cursor-pointer nav-card" 
             onclick="window.location.href='{{ route('admin.stock-opname.index') }}'">
            <div class="p-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h5 class="text-lg font-semibold text-green-600 mb-2">Stock Opname</h5>
                        <p class="text-gray-600 text-sm mb-4">
                            Kelola inventaris dan tentukan status stock produk apakah masuk kategori overmate atau tidak. Pantau ketersediaan stock secara real-time.
                        </p>
                        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Kelola Stock Opname
                        </button>
                    </div>
                    <div class="text-green-600 ml-4">
                        <i class="fas fa-boxes text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Data Master Card -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow cursor-pointer nav-card" 
             onclick="window.location.href='{{ route('admin.data-master') }}'">
            <div class="p-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h5 class="text-lg font-semibold text-cyan-600 mb-2">Data Master</h5>
                        <p class="text-gray-600 text-sm mb-4">
                            Kumpulan data master untuk referensi sistem, termasuk Overmate dan Work Order (Master Product). Kelola dan telusuri data acuan produksi.
                        </p>
                        <button class="bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Kelola Master Data
                        </button>
                    </div>
                    <div class="text-cyan-600 ml-4">
                        <i class="fas fa-database text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Card -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow cursor-pointer nav-card" 
             onclick="window.location.href='{{ route('admin.settings.index') }}'">
            <div class="p-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h5 class="text-lg font-semibold text-amber-600 mb-2">Settings & User Management</h5>
                        <p class="text-gray-600 text-sm mb-4">
                            Konfigurasi sistem, pengaturan user, role management, dan konfigurasi aplikasi lainnya.
                        </p>
                        <button class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Kelola Settings
                        </button>
                    </div>
                    <div class="text-amber-600 ml-4">
                        <i class="fas fa-cog text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="bg-white rounded-lg shadow-md mb-8">
        <div class="p-6">
            <h5 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Data</h5>
            <div class="h-80 relative">
                <canvas id="summaryDonutChart" 
                        data-labels="{{ json_encode($chartLabels ?? []) }}" 
                        data-values="{{ json_encode($chartValues ?? []) }}"></canvas>
            </div>
        </div>
    </div>


    <!-- Stats Cards -->
    <div class="bg-white rounded-lg shadow-md mb-8">
        <div class="px-6 py-4 border-b border-gray-200">
            <h5 class="text-lg font-semibold text-gray-900">Work Order</h5>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="stat-card">
                    <div class="stat-icon bg-blue-600">
                        <i class="fas fa-th-large text-white"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $stats['total_master_work_order'] ?? 0 }}</div>
                        <div class="stat-label">Total Data Master Work Order</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-cyan-600">
                        <i class="fas fa-clipboard-list text-white"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $stats['total_wo'] ?? 0 }}</div>
                        <div class="stat-label">Total Work Order</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-green-600">
                        <i class="fas fa-check-circle text-white"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $stats['completed_wo'] ?? 0 }}</div>
                        <div class="stat-label">Completed</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-amber-600">
                        <i class="fas fa-clock text-white"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $stats['on_progress_wo'] ?? 0 }}</div>
                        <div class="stat-label">On Progress</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stock Opname Stats -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="px-6 py-4 border-b border-gray-200">
            <h5 class="text-lg font-semibold text-gray-900">Stock Opname</h5>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="stat-card">
                    <div class="stat-icon bg-purple-600">
                        <i class="fas fa-list text-white"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $stats['total_overmate'] ?? 0 }}</div>
                        <div class="stat-label">Total Data Overmate Master</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-green-600">
                        <i class="fas fa-file-excel text-white"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $stats['total_excel_files'] ?? 0 }}</div>
                        <div class="stat-label">File Excel Uploaded</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
