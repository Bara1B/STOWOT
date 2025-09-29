@extends('layouts.public')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Header Section -->
        <div class="bg-white py-8 border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Daftar Work Orders</h1>
                <p class="text-lg text-gray-600 mb-2">
                    Monitor progress dan status semua Work Order secara real-time.
                    <span class="text-blue-600 font-medium">Hanya untuk informasi, tidak bisa diedit.</span>
                </p>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white py-6 border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <form method="GET" action="{{ route('public.work-orders') }}" class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Cari Work Order</h3>

                    <!-- Search Input -->
                    <div class="mb-4">
                        <div class="relative">
                            <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" 
                                placeholder="Cari berdasarkan WO Number atau Output..."
                                class="w-full pl-4 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Filters Row -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select name="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="all" {{ ($filters['status'] ?? 'all') == 'all' ? 'selected' : '' }}>Semua Status</option>
                                @foreach($statusOptions as $status)
                                    <option value="{{ $status }}" {{ ($filters['status'] ?? '') == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Penyelesaian</label>
                            <select name="completion_status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="" {{ ($filters['completion_status'] ?? '') == '' ? 'selected' : '' }}>Semua</option>
                                <option value="pending" {{ ($filters['completion_status'] ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ ($filters['completion_status'] ?? '') == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Due Date Dari</label>
                            <input type="date" name="due_date_from" value="{{ $filters['due_date_from'] ?? '' }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Due Date Sampai</label>
                            <input type="date" name="due_date_to" value="{{ $filters['due_date_to'] ?? '' }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="overdue" value="true" 
                                {{ ($filters['overdue'] ?? '') == 'true' ? 'checked' : '' }}
                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Hanya yang Overdue</span>
                        </label>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari
                        </button>
                        <a href="{{ route('public.work-orders') }}"
                            class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Work Orders Content -->
        <div class="py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                @if ($workOrders->count() > 0)
                    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-gray-600">
                                Menampilkan {{ $workOrders->firstItem() }} - {{ $workOrders->lastItem() }} 
                                dari {{ $workOrders->total() }} Work Orders
                            </p>
                            <p class="text-sm text-gray-500 mt-1">Klik "Lihat Progress" untuk melihat detail tracking</p>
                        </div>
                        @if(request()->hasAny(['search', 'status', 'completion_status', 'due_date_from', 'due_date_to', 'overdue']))
                            <div class="mt-2 sm:mt-0">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                    </svg>
                                    Filter Aktif
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($workOrders as $workOrder)
                            <div class="group bg-white rounded-xl border border-gray-200 p-6 hover:shadow-xl hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-1">
                                <!-- Header with Status Badge -->
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-200 line-clamp-2">
                                            {{ $workOrder->output ?? 'Antimo Tablet' }}
                                        </h3>
                                    </div>
                                    @php
                                        $isCompleted = $workOrder->status === 'Completed';
                                        $isOverdue = !$isCompleted && $workOrder->due_date && $workOrder->due_date->isPast();
                                    @endphp
                                    @if ($isOverdue)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700 border border-red-200">
                                            <div class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></div>
                                            Overdue
                                        </span>
                                    @elseif ($isCompleted)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 border border-green-200">
                                            <div class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></div>
                                            Selesai
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700 border border-blue-200">
                                            <div class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-1.5"></div>
                                            Progress
                                        </span>
                                    @endif
                                </div>

                                <!-- Work Order Info -->
                                <div class="bg-gray-50 rounded-lg p-3 mb-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Work Order</span>
                                        <span class="text-xs text-gray-400">#{{ $workOrder->id ?? '14' }}</span>
                                    </div>
                                    <p class="font-mono text-sm font-semibold text-gray-900">
                                        {{ $workOrder->wo_number ?? '8600200TT' }}
                                    </p>
                                </div>

                                <!-- Dates with Icons -->
                                <div class="space-y-3 mb-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="flex items-center justify-center w-6 h-6 bg-red-100 rounded-full mr-2">
                                                <svg class="w-3 h-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <span class="text-xs text-gray-500">Due Date</span>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ $workOrder->due_date ? $workOrder->due_date->format('d M Y') : '13 Sep 2025' }}
                                        </span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="flex items-center justify-center w-6 h-6 bg-green-100 rounded-full mr-2">
                                                <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <span class="text-xs text-gray-500">Created</span>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ $workOrder->created_at ? $workOrder->created_at->format('d M Y') : '12 Sep 2025' }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Progress Bar -->
                                <div class="mb-4">
                                    <div class="flex items-center justify-between text-xs text-gray-600 mb-2">
                                        <span class="font-medium">Progress</span>
                                        <span class="text-blue-600 font-semibold">14%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full transition-all duration-500 ease-out" style="width: 14%"></div>
                                    </div>
                                </div>

                                <!-- Action Button -->
                                <div class="pt-4 border-t border-gray-100">
                                    <a href="{{ route('public.tracking', $workOrder) }}"
                                        class="w-full inline-flex items-center justify-center px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors duration-200 group">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Lihat Progress
                                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if ($workOrders->hasPages())
                        <div class="mt-12">
                            <div class="flex flex-col sm:flex-row items-center justify-between bg-white rounded-xl shadow-sm border border-gray-200 p-6 gap-4">
                                <!-- Info Section -->
                                <div class="flex items-center space-x-3">
                                    <div class="flex items-center justify-center w-10 h-10 bg-blue-100 rounded-full">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">
                                            Halaman {{ $workOrders->currentPage() }} dari {{ $workOrders->lastPage() }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            Menampilkan {{ $workOrders->firstItem() }}-{{ $workOrders->lastItem() }} dari {{ $workOrders->total() }} work orders
                                        </p>
                                    </div>
                                </div>

                                <!-- Pagination Controls -->
                                <div class="flex items-center space-x-1">
                                    @if ($workOrders->onFirstPage())
                                        <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                            </svg>
                                        </span>
                                    @else
                                        <a href="{{ $workOrders->appends(request()->query())->previousPageUrl() }}" 
                                           class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-blue-600 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                            </svg>
                                        </a>
                                    @endif

                                    @foreach ($workOrders->appends(request()->query())->getUrlRange(1, $workOrders->lastPage()) as $page => $url)
                                        @if ($page == $workOrders->currentPage())
                                            <span class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg">
                                                {{ $page }}
                                            </span>
                                        @else
                                            <a href="{{ $url }}" 
                                               class="px-4 py-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors">
                                                {{ $page }}
                                            </a>
                                        @endif
                                    @endforeach

                                    @if ($workOrders->hasMorePages())
                                        <a href="{{ $workOrders->appends(request()->query())->nextPageUrl() }}" 
                                           class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-blue-600 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    @else
                                        <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada Work Orders</h3>
                        <p class="text-gray-600 mb-8 max-w-md mx-auto">Work orders akan muncul di sini setelah admin
                            membuatnya. Silakan cek kembali nanti.</p>
                        <a href="{{ route('public.home') }}"
                            class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Home
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
