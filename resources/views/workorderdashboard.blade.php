@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="py-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">Work Order Dashboard</h1>
                                <p class="text-sm text-gray-500">Manage and track work orders</p>
                            </div>
                        </div>
                        <!-- Removed New Work Order button as requested -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Statistics Cards -->
            @isset($totalWorkOrders)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
                    <!-- Total WO -->
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total WO</p>
                                <p class="text-2xl font-bold text-gray-900">{{ number_format($totalWorkOrders) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- On Progress -->
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">On Progress</p>
                                <p class="text-2xl font-bold text-yellow-600">{{ number_format($pendingWorkOrders) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Completed -->
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Completed</p>
                                <p class="text-2xl font-bold text-green-600">{{ number_format($completedWorkOrders) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Completed Late -->
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Completed Late</p>
                                <p class="text-2xl font-bold text-orange-600">{{ number_format($completedLateWorkOrders ?? 0) }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Overdue -->
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Overdue</p>
                                <p class="text-2xl font-bold text-red-600">{{ number_format($overdueWorkOrders) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
            <!-- Chart Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Work Order Trends</h3>
                        <p class="text-sm text-gray-500">Monthly work order statistics for {{ now()->year }}</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-indigo-500 rounded-full"></div>
                        <span class="text-sm text-gray-600">Work Orders</span>
                    </div>
                </div>
                <div class="h-80">
                    <canvas id="monthlyWoChart" class="w-full h-full"></canvas>
                </div>
            </div>
            <!-- Work Orders Management Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <!-- Header with Actions -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between p-6 border-b border-gray-200">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Work Orders Management</h3>
                        <p class="text-sm text-gray-500 mt-1">Manage and track all work orders</p>
                    </div>
                    @if (Auth::user()->role == 'admin')
                        <div class="flex flex-wrap gap-3 mt-4 sm:mt-0">
                            <a href="{{ route('work-orders.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add Single WO
                            </a>
                            <a href="{{ route('work-orders.bulk-create') }}"
                                class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                    </path>
                                </svg>
                                Bulk Add WO
                            </a>
                            <button type="button" id="open-export-modal-btn"
                                class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Export Laporan
                            </button>
                        </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="p-6">
                    <!-- Success Alert -->
                    @if (session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <button type="button" class="inline-flex text-green-400 hover:text-green-600"
                                        onclick="this.parentElement.parentElement.parentElement.remove()">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- Filters Section -->
                    <div class="mb-6 bg-gray-50 rounded-xl border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wide">Filters</h4>
                            <button type="button" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium"
                                onclick="document.getElementById('filterForm').reset(); window.location.href='{{ route('workorderdashboard') }}';">
                                Clear All
                            </button>
                        </div>
                        <form id="filterForm" action="{{ route('workorderdashboard') }}" method="GET"
                            class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <!-- Search -->
                                <div class="space-y-2">
                                    <label for="search" class="block text-sm font-medium text-gray-700">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                        Search
                                    </label>
                                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                                        placeholder="WO Number or Product..."
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                </div>

                                <!-- Status Filter -->
                                <div class="space-y-2">
                                    <label for="filter_status" class="block text-sm font-medium text-gray-700">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Status
                                    </label>
                                    <select name="filter_status" id="filter_status"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                        <option value="">All Status</option>
                                        <option value="On Progress"
                                            {{ request('filter_status') == 'On Progress' ? 'selected' : '' }}>On Progress
                                        </option>
                                        <option value="Completed"
                                            {{ request('filter_status') == 'Completed' ? 'selected' : '' }}>Completed
                                        </option>
                                    </select>
                                </div>

                                <!-- Due Date Range Filter -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        Due Date Range
                                    </label>
                                    <div class="grid grid-cols-2 gap-2">
                                        <div>
                                            <input type="date" name="due_date_from" id="due_date_from"
                                                value="{{ request('due_date_from', now()->format('Y-m-d')) }}"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 text-sm"
                                                placeholder="Dari tanggal">
                                        </div>
                                        <div>
                                            <input type="date" name="due_date_to" id="due_date_to"
                                                value="{{ request('due_date_to') }}"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 text-sm"
                                                placeholder="Sampai tanggal">
                                        </div>
                                    </div>
                                    <div class="flex justify-between text-xs text-gray-500">
                                        <span>Dari</span>
                                        <span>Sampai</span>
                                    </div>
                                </div>

                                <!-- Month Filter -->
                                <div class="space-y-2">
                                    <label for="filter_month" class="block text-sm font-medium text-gray-700">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        Month
                                    </label>
                                    <select name="filter_month" id="filter_month"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                        <option value="">All Months</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}"
                                                {{ request('filter_month') == $i ? 'selected' : '' }}>
                                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <!-- Filter Actions -->
                            <div
                                class="flex flex-col sm:flex-row sm:items-center sm:justify-between pt-4 border-t border-gray-200">
                                <div class="text-sm text-gray-500 mb-3 sm:mb-0">
                                    @if (request()->hasAny(['search', 'filter_status', 'due_date_from', 'due_date_to', 'filter_month']))
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                            Filters Applied
                                        </span>
                                    @endif
                                </div>
                                <div class="flex space-x-3">
                                    <a href="{{ route('workorderdashboard') }}"
                                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                            </path>
                                        </svg>
                                        Reset
                                    </a>
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z">
                                            </path>
                                        </svg>
                                        Apply Filters
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Debug buttons removed as requested --}}

                {{-- Form Aksi Massal & Tabel --}}
                <form id="bulk-actions-form" action="{{ route('work-orders.bulk-destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <!-- Modern Bulk Actions Toolbar -->
                    <div id="bulk-actions-toolbar" class="mb-6 hidden">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-4">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-blue-800">
                                        <span id="selected-count-display">0</span> item dipilih
                                    </span>
                                </div>
                                <button type="button" id="clear-selection"
                                    class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Clear Selection
                                </button>
                            </div>
                            <div class="flex flex-wrap gap-3">
                                <button type="button"
                                    class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold rounded-lg shadow-sm hover:shadow-md transition-all duration-200 transform hover:scale-105 bulk-action-btn"
                                    data-target="#editDueDateModal">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    Edit Due Date
                                </button>
                                <button type="button" id="delete-selected-btn" data-action="bulk-delete"
                                    class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-semibold rounded-lg shadow-sm hover:shadow-md transition-all duration-200 transform hover:scale-105 bulk-action-btn">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Hapus Terpilih
                                </button>
                                <a href="#" id="export-selected-btn"
                                    class="inline-flex items-center px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-semibold rounded-lg shadow-sm hover:shadow-md transition-all duration-200 transform hover:scale-105 no-underline bulk-action-btn">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    Export Terpilih
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto" id="work-order-table">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <input
                                            class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500 focus:ring-2"
                                            type="checkbox" id="select-all">
                                    </th>

                                    @php
                                        // Helper untuk membuat link pengurutan
                                        function sortable_header($label, $column)
                                        {
                                            $sortBy = request('sort_by', 'created_at');
                                            $sortDirection = request('sort_direction', 'desc');
                                            $newDirection =
                                                $sortBy == $column && $sortDirection == 'asc' ? 'desc' : 'asc';
                                            $icon = '';
                                            if ($sortBy == $column) {
                                                $icon =
                                                    $sortDirection == 'asc'
                                                        ? '<i class="ml-1">↑</i>'
                                                        : '<i class="ml-1">↓</i>';
                                            }
                                            // Menggabungkan semua parameter filter yang ada
                                            $url = request()->fullUrlWithQuery([
                                                'sort_by' => $column,
                                                'sort_direction' => $newDirection,
                                            ]);
                                            // Menambahkan jangkar ke URL
                                            return '<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><a href="' .
                                                $url .
                                                '" class="text-gray-900 hover:text-gray-700 no-underline">' .
                                                $label .
                                                ' ' .
                                                $icon .
                                                '</a></th>';
                                        }
                                    @endphp

                                    {!! sortable_header('No. Work Order', 'wo_number') !!}
                                    {!! sortable_header('Nama Produk', 'output') !!}
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Group</th>
                                    {!! sortable_header('WO Diterima', 'wo_diterima_date') !!}
                                    {!! sortable_header('Due Date', 'due_date') !!}
                                    {!! sortable_header('Status', 'status') !!}

                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($workOrders as $wo)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <input
                                                class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500 focus:ring-2 row-checkbox"
                                                type="checkbox" value="{{ $wo->id }}">
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $wo->wo_number }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $wo->output ?? '-' }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $wo->masterProduct?->group ?? '-' }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $wo->woDiterimaTracking?->completed_at?->translatedFormat('d M Y') ?? '-' }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($wo->due_date)->translatedFormat('d M Y') }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            @php
                                                // Tentukan tanggal selesai aktual: pakai completed_on jika ada,
                                                // fallback ke tanggal terakhir langkah tracking yang selesai.
                                                $actualCompletedOn =
                                                    $wo->completed_on ?? $wo->tracking?->max('completed_at');
                                                $isLate = false;

                                                if (
                                                    $wo->status === 'Completed' &&
                                                    $actualCompletedOn &&
                                                    $wo->due_date
                                                ) {
                                                    $actualCompletedOn = \Carbon\Carbon::parse($actualCompletedOn);
                                                    $dueDate = \Carbon\Carbon::parse($wo->due_date);
                                                    // Cek apakah selesai setelah due date (terlambat)
                                                    $isLate = $actualCompletedOn->gt($dueDate);
                                                }
                                            @endphp
                                            @if ($wo->status == 'Completed')
                                                @if ($isLate)
                                                    <span
                                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Completed
                                                        (Late)
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                                                @endif
                                            @else
                                                <span
                                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ $wo->status }}</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('work-order.show', $wo) }}"
                                                class="text-gray-700 hover:text-gray-900 mr-2" title="Track">🔍</a>
                                            @if (Auth::user()->role == 'admin')
                                                <a href="{{ route('work-orders.edit', $wo) }}"
                                                    class="text-yellow-600 hover:text-yellow-900" title="Edit">✏️</a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-4 py-8 text-center">
                                            <div class="text-gray-500">
                                                <div class="text-4xl mb-2">📋</div>
                                                <div class="font-medium text-lg">Work Order tidak ditemukan</div>
                                                <div class="text-sm">Tidak ada data yang sesuai dengan
                                                    filter</div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </form>
                {{-- Simple Pagination --}}
                <div class="mt-6 bg-white border border-gray-200 rounded-lg shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Menampilkan <span class="font-semibold">{{ $workOrders->firstItem() ?? 0 }}</span>
                                    sampai <span class="font-semibold">{{ $workOrders->lastItem() ?? 0 }}</span>
                                    dari <span class="font-semibold">{{ $workOrders->total() }}</span> hasil
                                </p>
                            </div>
                            @if ($workOrders->hasPages())
                                <div class="flex items-center space-x-1">
                                    {{-- Previous Button --}}
                                    @if ($workOrders->onFirstPage())
                                        <span
                                            class="px-2 py-2 text-sm bg-gray-100 text-gray-400 rounded-md cursor-not-allowed">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 19l-7-7 7-7"></path>
                                            </svg>
                                        </span>
                                    @else
                                        <a href="{{ $workOrders->previousPageUrl() }}"
                                            class="px-2 py-2 text-sm bg-white text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 19l-7-7 7-7"></path>
                                            </svg>
                                        </a>
                                    @endif

                                    {{-- Page Numbers --}}
                                    @for ($page = max(1, $workOrders->currentPage() - 3); $page <= min($workOrders->lastPage(), $workOrders->currentPage() + 3); $page++)
                                        @if ($page == $workOrders->currentPage())
                                            <span
                                                class="px-3 py-2 text-sm bg-indigo-600 text-white rounded-md font-semibold">
                                                {{ $page }}
                                            </span>
                                        @else
                                            <a href="{{ $workOrders->url($page) }}"
                                                class="px-3 py-2 text-sm bg-white text-gray-700 border border-gray-300 rounded-md hover:bg-indigo-50 hover:text-indigo-600">
                                                {{ $page }}
                                            </a>
                                        @endif
                                    @endfor

                                    {{-- Next Button --}}
                                    @if ($workOrders->hasMorePages())
                                        <a href="{{ $workOrders->nextPageUrl() }}"
                                            class="px-2 py-2 text-sm bg-white text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    @else
                                        <span
                                            class="px-2 py-2 text-sm bg-gray-100 text-gray-400 rounded-md cursor-not-allowed">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <!-- Modal Export Excel -->
    <div class="tw-modal hidden fixed inset-0 z-50" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel"
        aria-hidden="true">
        <div class="fixed inset-0 bg-black bg-opacity-50"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="relative bg-white rounded-lg shadow-xl max-w-md w-full mx-auto">
                <div class="flex justify-between items-center p-6 border-b border-gray-200">
                    <h5 class="text-lg font-bold text-gray-900" id="exportModalLabel">Export Laporan Work Order</h5>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center"
                        data-dismiss="modal" aria-label="Close">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <form id="export-form" action="{{ route('work-orders.export') }}" method="GET">
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Pilih periode laporan berdasarkan tanggal "WO Diterima".</p>
                        <div class="mb-4">
                            <label for="export_month" class="block text-sm font-medium text-gray-700 mb-2">Bulan</label>
                            <select id="export_month" name="month"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" {{ $m == now()->month ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="export_year" class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                            <select id="export_year" name="year"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @for ($y = now()->year; $y >= 2020; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <small class="text-gray-500 text-sm">Jika Anda tidak memilih item di tabel, semua WO pada periode
                            terpilih
                            akan
                            diekspor.</small>
                    </div>
                    <div class="flex justify-end space-x-3 p-6 border-t border-gray-200 bg-gray-50 rounded-b-lg">
                        <button type="button" data-dismiss="modal"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Download Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Due Date -->
    <div class="tw-modal hidden fixed inset-0 z-50" id="editDueDateModal" tabindex="-1"
        aria-labelledby="editDueDateModalLabel" aria-hidden="true">
        <div class="fixed inset-0 bg-black bg-opacity-50"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="relative bg-white rounded-lg shadow-xl max-w-md w-full mx-auto">
                <div class="flex justify-between items-center p-6 border-b border-gray-200">
                    <h5 class="text-lg font-bold text-gray-900" id="editDueDateModalLabel">Update Due Date Borongan</h5>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center"
                        data-dismiss="modal" aria-label="Close">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <form id="bulk-edit-form" action="{{ route('work-orders.bulk-update-due-date') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Anda akan mengubah due date untuk <strong
                                id="selected-count"></strong> item yang dipilih.
                        </p>
                        <div class="mb-4">
                            <label for="new_due_date" class="block text-sm font-medium text-gray-700 mb-2">Pilih Due Date
                                Baru</label>
                            <input type="date"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                id="new_due_date" name="new_due_date" required>
                        </div>
                        <div id="bulk-edit-ids-container"></div>
                    </div>
                    <div class="flex justify-end space-x-3 p-6 border-t border-gray-200 bg-gray-50 rounded-b-lg">
                        <button type="button" data-dismiss="modal"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Update Due Date
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Custom Confirmation Modal -->
    <div class="tw-modal hidden fixed inset-0 z-50" id="confirmationModal" tabindex="-1" aria-hidden="true">
        <div class="fixed inset-0 bg-black bg-opacity-50"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="relative bg-white rounded-lg shadow-xl max-w-md w-full mx-auto">
                <div class="p-6 text-center">
                    <!-- Icon -->
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full mb-4"
                        id="confirmation-icon-container">
                        <!-- Icon will be inserted here dynamically -->
                    </div>

                    <!-- Title -->
                    <h3 class="text-lg font-semibold text-gray-900 mb-2" id="confirmation-title">
                        Konfirmasi
                    </h3>

                    <!-- Message -->
                    <p class="text-sm text-gray-600 mb-6" id="confirmation-message">
                        Apakah Anda yakin ingin melanjutkan?
                    </p>

                    <!-- Buttons -->
                    <div class="flex justify-center space-x-3">
                        <button type="button" id="confirmation-cancel"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Batal
                        </button>
                        <button type="button" id="confirmation-confirm"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Ya, Lanjutkan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Form Hapus Borongan (sekarang tersembunyi) --}}
    <form id="bulk-delete-form" action="{{ route('work-orders.bulk-destroy') }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
        <div id="bulk-delete-ids-container"></div>
    </form>
@endsection

@push('scripts')
    <script>
        (function() {
            function onReady(fn) {
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', fn);
                } else {
                    fn();
                }
            }

            function initDashboardScripts() {
                // Enhanced scroll position memory
                try {
                    const scrollStorageKey = 'dashboard:lastScrollY';

                    // Function to save current scroll position
                    function saveScrollPosition() {
                        sessionStorage.setItem(scrollStorageKey, String(window.scrollY || 0));
                    }

                    // Restore last scroll position
                    if (!location.hash) {
                        const savedY = sessionStorage.getItem(scrollStorageKey);
                        if (savedY) {
                            // Delay scroll restoration to ensure page is fully loaded
                            setTimeout(() => {
                                window.scrollTo(0, parseInt(savedY, 10) || 0);
                            }, 100);
                        }
                    }

                    // Save scroll position on various events
                    window.addEventListener('beforeunload', saveScrollPosition);

                    // Save scroll position when forms are submitted
                    document.addEventListener('submit', function(e) {
                        // Only save if it's not a modal form
                        if (!e.target.closest('.modal')) {
                            saveScrollPosition();
                        }
                    });

                    // Fallback: open export modal by ID (in case data attributes aren't processed)
                    const openExportBtn = document.getElementById('open-export-modal-btn');
                    if (openExportBtn) {
                        openExportBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            const m = document.getElementById('exportModal');
                            if (m) {
                                console.debug('Opening modal via fallback #open-export-modal-btn');
                                m.classList.remove('hidden');
                                m.setAttribute('aria-hidden', 'false');
                            }
                        });
                    }

                    // Save scroll position when action buttons are clicked
                    document.addEventListener('click', function(e) {
                        // Save on delete, edit, or bulk action buttons
                        if (e.target.matches('[onclick*="delete"]') ||
                            e.target.matches('button[type="submit"]') ||
                            e.target.closest('form[method="POST"]')) {
                            saveScrollPosition();
                        }
                    });

                } catch (e) {
                    // no-op if storage is unavailable
                }
                // Skrip untuk Grafik (tunggu Chart tersedia dari bundle Vite atau fallback)
                onReady(function() {
                    function tryInitMonthly() {
                        const canvas = document.getElementById('monthlyWoChart');

                        if (!canvas || !window.Chart) {
                            return false;
                        }

                        // Prevent double initialization
                        if (canvas.dataset.chartInited === '1') {
                            return true;
                        }

                        fetch("{{ route('charts.monthly-wo') }}")
                            .then(response => {
                                return response.json();
                            })
                            .then(data => {
                                let labels = data.labels || [];
                                let values = data.values || [];

                                // Only create dummy data if no real data exists
                                if (labels.length === 0 && values.length === 0) {
                                    labels = ['No Data Available'];
                                    values = [1];
                                }

                                const bg = 'rgba(59, 130, 246, 0.6)';
                                const border = 'rgba(59, 130, 246, 1)';
                                const ctx = canvas.getContext('2d');

                                try {
                                    // eslint-disable-next-line no-new
                                    const chart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels,
                                            datasets: [{
                                                label: 'Total WO',
                                                data: values,
                                                backgroundColor: bg,
                                                borderColor: border,
                                                borderWidth: 1,
                                            }],
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            },
                                            plugins: {
                                                legend: {
                                                    display: false
                                                },
                                                tooltip: {
                                                    enabled: true
                                                }
                                            },
                                        },
                                    });
                                    canvas.dataset.chartInited = '1';
                                } catch (error) {
                                    console.error('[Chart Debug] WO Error creating bar chart:', error);
                                }
                            })
                            .catch(err => {
                                console.error('[Chart Debug] WO Fetch error:', err);
                                // Create dummy chart on fetch error
                                const ctx = canvas.getContext('2d');
                                try {
                                    // eslint-disable-next-line no-new
                                    const chart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: ['Error'],
                                            datasets: [{
                                                label: 'Total WO',
                                                data: [0],
                                                backgroundColor: 'rgba(239, 68, 68, 0.6)',
                                                borderColor: 'rgba(239, 68, 68, 1)',
                                                borderWidth: 1,
                                            }],
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            },
                                            plugins: {
                                                legend: {
                                                    display: false
                                                },
                                                tooltip: {
                                                    enabled: true
                                                }
                                            },
                                        },
                                    });
                                    canvas.dataset.chartInited = '1';
                                } catch (fallbackError) {
                                    console.error('[Chart Debug] WO Fallback chart error:', fallbackError);
                                }
                            });
                        return true;
                    }

                    // Try immediately, then poll if Chart not ready
                    if (!tryInitMonthly()) {
                        const iv = setInterval(() => {
                            if (tryInitMonthly()) clearInterval(iv);
                        }, 100);
                        setTimeout(() => clearInterval(iv), 5000);
                    }
                });

                // Bulk actions logic
                const selectAllCheckbox = document.getElementById('select-all');
                const rowCheckboxes = document.querySelectorAll('.row-checkbox');
                const bulkActionsToolbar = document.getElementById('bulk-actions-toolbar');
                const exportSelectedBtn = document.getElementById('export-selected-btn');
                const deleteSelectedBtn = document.getElementById('delete-selected-btn');
                const selectedCountDisplay = document.getElementById('selected-count-display');
                const clearSelectionBtn = document.getElementById('clear-selection');

                function updateToolbarVisibility() {
                    const checkedBoxes = Array.from(rowCheckboxes).filter(cb => cb.checked);
                    const anyChecked = checkedBoxes.length > 0;

                    if (bulkActionsToolbar) {
                        bulkActionsToolbar.classList.toggle('hidden', !anyChecked);
                    }

                    if (selectedCountDisplay) {
                        selectedCountDisplay.textContent = checkedBoxes.length;
                    }

                    // Update export URL with selected IDs
                    if (exportSelectedBtn && checkedBoxes.length > 0) {
                        const selectedIds = checkedBoxes.map(cb => cb.value).join(',');
                        const baseUrl = '{{ route('work-orders.export') }}';
                        exportSelectedBtn.href = baseUrl + '?ids=' + selectedIds;
                    }
                }

                if (selectAllCheckbox) {
                    selectAllCheckbox.addEventListener('change', function() {
                        rowCheckboxes.forEach(cb => cb.checked = selectAllCheckbox.checked);
                        updateToolbarVisibility();
                    });
                }

                // Clear selection button
                if (clearSelectionBtn) {
                    clearSelectionBtn.addEventListener('click', function() {
                        rowCheckboxes.forEach(cb => cb.checked = false);
                        if (selectAllCheckbox) {
                            selectAllCheckbox.checked = false;
                        }
                        updateToolbarVisibility();
                    });
                }

                // Add event listeners to row checkboxes
                rowCheckboxes.forEach((cb) => {
                    cb.addEventListener('change', function() {
                        updateToolbarVisibility();
                    });
                });

                // Bulk delete handling
                if (deleteSelectedBtn) {
                    deleteSelectedBtn.addEventListener('click', function(e) {
                        e.preventDefault();

                        const selectedItems = document.querySelectorAll('.row-checkbox:checked');
                        if (selectedItems.length === 0) {
                            alert('Pilih minimal satu item untuk dihapus.');
                            return;
                        }

                        if (confirm(
                                'Apakah Anda yakin ingin menghapus ' + selectedItems.length +
                                ' work order yang dipilih? Tindakan ini tidak dapat dibatalkan.'
                            )) {
                            // Get form elements
                            const bulkDeleteForm = document.getElementById('bulk-delete-form');
                            const bulkDeleteIdsContainer = document.getElementById('bulk-delete-ids-container');

                            // Clear previous inputs
                            bulkDeleteIdsContainer.innerHTML = '';

                            // Append hidden inputs for selected IDs
                            selectedItems.forEach(cb => {
                                const input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = 'ids[]';
                                input.value = cb.value;
                                bulkDeleteIdsContainer.appendChild(input);
                            });

                            bulkDeleteForm.submit();
                        }
                    });
                }

                // Export selected handling (link -> GET with ids[])
                if (exportSelectedBtn) {
                    exportSelectedBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const selected = Array.from(document.querySelectorAll('.row-checkbox:checked')).map(
                            cb => cb.value);
                        if (selected.length === 0) {
                            alert('Pilih minimal satu item untuk diekspor.');
                            return;
                        }
                        const params = new URLSearchParams();
                        selected.forEach(id => params.append('ids[]', id));
                        const url = '{{ route('work-orders.export') }}?' + params.toString();
                        window.location.href = url;
                    });
                }

                // Bulk edit due date handling
                const editDueDateModal = document.getElementById('editDueDateModal');
                const bulkEditForm = document.getElementById('bulk-edit-form');
                const bulkEditIdsContainer = document.getElementById('bulk-edit-ids-container');
                const selectedCountElement = document.getElementById('selected-count');

                // Modal handling functions
                function showModal(modalId) {
                    const modal = document.getElementById(modalId);
                    if (modal) {
                        modal.classList.remove('hidden');
                        modal.setAttribute('aria-hidden', 'false');
                        document.body.style.overflow = 'hidden';
                    }
                }

                function hideModal(modalId) {
                    const modal = document.getElementById(modalId);
                    if (modal) {
                        modal.classList.add('hidden');
                        modal.setAttribute('aria-hidden', 'true');
                        document.body.style.overflow = '';
                    }
                }

                // Edit Due Date Modal handling
                document.addEventListener('click', function(e) {
                    // Open edit due date modal
                    if (e.target.matches('[data-target="#editDueDateModal"]') || e.target.closest(
                            '[data-target="#editDueDateModal"]')) {
                        e.preventDefault();
                        const selectedItems = document.querySelectorAll('.row-checkbox:checked');
                        if (selectedItems.length === 0) {
                            alert('Pilih minimal satu item untuk diedit due date.');
                            return;
                        }

                        // Update count in modal
                        if (selectedCountElement) {
                            selectedCountElement.textContent = selectedItems.length;
                        }

                        // Clear previous inputs
                        if (bulkEditIdsContainer) {
                            bulkEditIdsContainer.innerHTML = '';

                            // Add hidden inputs for selected IDs
                            selectedItems.forEach(cb => {
                                const input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = 'ids[]';
                                input.value = cb.value;
                                bulkEditIdsContainer.appendChild(input);
                            });
                        }

                        showModal('editDueDateModal');
                    }

                    // Open export modal
                    if (e.target.matches('#open-export-modal-btn') || e.target.closest(
                            '#open-export-modal-btn')) {
                        e.preventDefault();
                        showModal('exportModal');
                    }

                    // Close modal buttons
                    if (e.target.matches('[data-dismiss="modal"]') || e.target.closest(
                            '[data-dismiss="modal"]')) {
                        e.preventDefault();
                        const modal = e.target.closest('.tw-modal');
                        if (modal) {
                            hideModal(modal.id);
                        }
                    }

                    // Close modal when clicking outside
                    if (e.target.matches('.tw-modal')) {
                        hideModal(e.target.id);
                    }
                });

                // Custom Confirmation Modal Functions
                let confirmationCallback = null;

                function showConfirmation(options = {}) {
                    const modal = document.getElementById('confirmationModal');
                    const iconContainer = document.getElementById('confirmation-icon-container');
                    const title = document.getElementById('confirmation-title');
                    const message = document.getElementById('confirmation-message');
                    const confirmBtn = document.getElementById('confirmation-confirm');

                    // Set default values
                    const config = {
                        title: options.title || 'Konfirmasi',
                        message: options.message || 'Apakah Anda yakin ingin melanjutkan?',
                        confirmText: options.confirmText || 'Ya, Lanjutkan',
                        confirmClass: options.confirmClass || 'bg-red-600 hover:bg-red-700',
                        icon: options.icon || 'warning',
                        onConfirm: options.onConfirm || null
                    };

                    // Set content
                    title.textContent = config.title;
                    message.textContent = config.message;
                    confirmBtn.textContent = config.confirmText;
                    confirmBtn.className =
                        'text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors ' + config.confirmClass;

                    // Set icon
                    let iconHTML = '';
                    let iconBgClass = '';

                    if (config.icon === 'warning') {
                        iconBgClass = 'bg-red-100';
                        iconHTML =
                            '<svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">' +
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"></path>' +
                            '</svg>';
                    } else if (config.icon === 'info') {
                        iconBgClass = 'bg-blue-100';
                        iconHTML =
                            '<svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">' +
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>' +
                            '</svg>';
                    }

                    iconContainer.className =
                        'mx-auto flex items-center justify-center h-12 w-12 rounded-full mb-4 ' + iconBgClass;
                    iconContainer.innerHTML = iconHTML;

                    // Store callback
                    confirmationCallback = config.onConfirm;

                    // Show modal
                    showModal('confirmationModal');
                }

                // Handle confirmation modal buttons
                document.getElementById('confirmation-cancel').addEventListener('click', function() {
                    hideModal('confirmationModal');
                    confirmationCallback = null;
                });

                document.getElementById('confirmation-confirm').addEventListener('click', function() {
                    hideModal('confirmationModal');
                    if (confirmationCallback && typeof confirmationCallback === 'function') {
                        confirmationCallback();
                    }
                    confirmationCallback = null;
                });

                // Handle bulk delete with confirmation
                document.addEventListener('click', function(e) {
                    if (e.target.matches('[data-action="bulk-delete"]') || e.target.closest(
                            '[data-action="bulk-delete"]')) {
                        e.preventDefault();

                        const selectedItems = document.querySelectorAll('.row-checkbox:checked');
                        if (selectedItems.length === 0) {
                            showConfirmation({
                                title: 'Tidak Ada Item Terpilih',
                                message: 'Silakan pilih item yang ingin dihapus terlebih dahulu.',
                                confirmText: 'OK',
                                confirmClass: 'bg-blue-600 hover:bg-blue-700',
                                icon: 'info'
                            });
                            return;
                        }

                        showConfirmation({
                            title: 'Konfirmasi Hapus',
                            message: 'Apakah Anda yakin ingin menghapus ' + selectedItems.length +
                                ' item yang dipilih? Tindakan ini tidak dapat dibatalkan.',
                            confirmText: 'Ya, Hapus',
                            confirmClass: 'bg-red-600 hover:bg-red-700',
                            icon: 'warning',
                            onConfirm: function() {
                                // Prepare form data
                                const bulkDeleteForm = document.getElementById('bulk-delete-form');
                                const bulkDeleteIdsContainer = document.getElementById(
                                    'bulk-delete-ids-container');

                                // Clear existing inputs
                                bulkDeleteIdsContainer.innerHTML = '';

                                // Add selected IDs
                                selectedItems.forEach(cb => {
                                    const input = document.createElement('input');
                                    input.type = 'hidden';
                                    input.name = 'ids[]';
                                    input.value = cb.value;
                                    bulkDeleteIdsContainer.appendChild(input);
                                });

                                // Submit form
                                bulkDeleteForm.submit();
                            }
                        });
                    }
                });

                // Initialize toolbar visibility
                updateToolbarVisibility();

                // Handle Escape key to close modals
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        const openModals = document.querySelectorAll('.tw-modal:not(.hidden)');
                        openModals.forEach(modal => {
                            hideModal(modal.id);
                        });
                    }
                });
            }

            // Initialize the dashboard scripts
            initDashboardScripts();
        })();
    </script>
@endpush
