@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Data Master</h1>
        <p class="text-gray-600 mt-2">Kumpulan data master untuk referensi sistem</p>
    </div>

    <!-- Main Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Data Item STO GBK dan GBB Card -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow cursor-pointer" 
             onclick="window.location.href='{{ route('overmate.index') }}'">
            <div class="p-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h5 class="text-lg font-semibold text-purple-600 mb-2">Data Item STO GBK dan GBB</h5>
                        <p class="text-gray-600 text-sm mb-4">
                            Kelola data item Stock Taking Operation untuk GBK dan GBB, referensi stock opname dan analisis inventory.
                        </p>
                        <button class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Kelola Data Item STO
                        </button>
                    </div>
                    <div class="text-purple-600 ml-4">
                        <i class="fas fa-chart-line text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Work Order Data Card -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow cursor-pointer" 
             onclick="window.location.href='{{ route('work-orders.data.index') }}'">
            <div class="p-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h5 class="text-lg font-semibold text-indigo-600 mb-2">Work Order Data</h5>
                        <p class="text-gray-600 text-sm mb-4">
                            Kelola data master produk untuk work order dan referensi produksi sistem.
                        </p>
                        <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Kelola Work Order Data
                        </button>
                    </div>
                    <div class="text-indigo-600 ml-4">
                        <i class="fas fa-clipboard-list text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="px-6 py-4 border-b border-gray-200">
            <h5 class="text-lg font-semibold text-gray-900">Ringkasan Data Master</h5>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="stat-card">
                    <div class="stat-icon bg-purple-600">
                        <i class="fas fa-chart-line text-white"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $stats['total_overmate'] ?? 0 }}</div>
                        <div class="stat-label">Total Data Item STO GBK dan GBB</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-indigo-600">
                        <i class="fas fa-clipboard-list text-white"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $stats['total_master_work_order'] ?? 0 }}</div>
                        <div class="stat-label">Total Work Order Master</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
