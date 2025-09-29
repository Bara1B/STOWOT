@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
                <div class="mb-4 sm:mb-0">
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Data Stock Opname</h1>
                    <p class="text-gray-600">File: <span class="font-semibold text-gray-900">{{ $stockOpnameFile->original_name }}</span></p>
                </div>

    <!-- Add Row Modal -->
    @if (Auth::user() && Auth::user()->role === 'admin')
    <div id="addRowModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Tambah Baris Stock Opname</h3>
                <button onclick="closeAddRowModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.stock-opname.add-row', $stockOpnameFile->id) }}" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Location System</label>
                        <input type="text" name="location_system" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Item Number</label>
                        <input type="text" name="item_number" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <input type="text" name="description" class="w-full px-3 py-2 border rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Manufacturer</label>
                        <input type="text" name="manufacturer" class="w-full px-3 py-2 border rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lot Serial</label>
                        <input type="text" name="lot_serial" class="w-full px-3 py-2 border rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Reference</label>
                        <input type="text" name="reference" class="w-full px-3 py-2 border rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Unit of Measure</label>
                        <input type="text" name="unit_of_measure" class="w-full px-3 py-2 border rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Quantity On Hand</label>
                        <input type="number" step="0.00001" name="quantity_on_hand" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Stok Fisik</label>
                        <input type="number" step="0.00001" name="stok_fisik" class="w-full px-3 py-2 border rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Expire Date</label>
                        <input type="date" name="expired_date" class="w-full px-3 py-2 border rounded-md">
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeAddRowModal()" class="px-4 py-2 border rounded-md">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    @endif
                <div class="flex flex-col sm:flex-row gap-3">
                    @if (Auth::user() && Auth::user()->role === 'admin')
                        <button type="button" onclick="openAddRowModal()"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Baris
                        </button>
                    @endif
                    <a href="{{ Auth::user() && Auth::user()->role === 'admin' ? route('admin.stock-opname.index') : route('stock-opname.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke List File
                    </a>
                    <a href="{{ Auth::user() && Auth::user()->role === 'admin' ? route('admin.stock-opname.export-data', $stockOpnameFile->id) : route('stock-opname.export-data', $stockOpnameFile->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Export Excel
                    </a>
                </div>
            </div>

            <!-- File Info Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8 overflow-hidden">
                <div class="p-6 flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-14 h-14 bg-green-100 text-green-600 flex items-center justify-center rounded-xl">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-3 mb-2">
                            <h2 class="text-lg font-semibold text-gray-900 truncate">{{ $stockOpnameFile->original_name }}</h2>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                ID: {{ $stockOpnameFile->id }}
                            </span>
                        </div>
                        <div class="text-sm text-gray-500">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Diunggah: {{ optional($stockOpnameFile->created_at)->format('d M Y, H:i') }}
                                @if (isset($stockOpnames))
                                    <span class="mx-2">•</span>
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    Total baris: {{ method_exists($stockOpnames, 'total') ? $stockOpnames->total() : $stockOpnames->count() }}
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <a href="{{ route('stock-opname.export-data', $stockOpnameFile->id) }}" 
                           class="inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Export
                        </a>
                    </div>
                </div>
            </div>

            @if ($stockOpnames && $stockOpnames->count() > 0)
                <!-- Data Table -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Tabel Data Stock Opname</h3>
                    </div>
                    <!-- Filters Toolbar -->
                    <div class="px-6 py-4 border-b border-gray-100 bg-white">
                        @php
                            $showDataRoute = Auth::user() && Auth::user()->role === 'admin'
                                ? route('admin.stock-opname.show-data', $stockOpnameFile->id)
                                : route('stock-opname.show-data', $stockOpnameFile->id);
                        @endphp
                        <form method="GET" action="{{ $showDataRoute }}" class="flex flex-col md:flex-row md:items-center gap-3">
                            <div class="relative w-full md:w-96">
                                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10.5A6.5 6.5 0 114 10.5a6.5 6.5 0 0113 0z" />
                                </svg>
                                <input name="q" value="{{ request('q') }}" type="text" placeholder="Cari (location, item, description, lot, reference)" class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                            </div>
                            <div class="flex items-center gap-2">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    Cari
                                </button>
                                @if(request()->filled('q'))
                                    <a href="{{ $showDataRoute }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 rounded-lg">Reset</a>
                                @endif
                            </div>
                            <div class="text-sm text-gray-600 md:ml-auto">
                                <span>{{ method_exists($stockOpnames, 'total') ? $stockOpnames->total() : $stockOpnames->count() }}</span> baris
                            </div>
                        </form>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location System</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location Actual</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item Number</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Manufacturer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lot Serial</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reference</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expire Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity on Hand</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok Fisik</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Overmate Qty</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Selisih</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Masuk Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">History Tracing</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($stockOpnames as $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->location_system }}</td>
                                        <!-- Location Actual Column -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if (Auth::user() && Auth::user()->role === 'admin')
                                                <form action="{{ route('admin.stock-opname.update-location-actual', $item->id) }}" method="POST" class="location-actual-form">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="flex items-center space-x-2">
                                                        <select name="location_actual_status" class="location-status-select text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" onchange="toggleKeteranganField(this)">
                                                            <option value="">Pilih</option>
                                                            <option value="centang" {{ $item->location_actual_status === 'centang' ? 'selected' : '' }}>✓</option>
                                                            <option value="x" {{ $item->location_actual_status === 'x' ? 'selected' : '' }}>✗</option>
                                                        </select>
                                                        <div class="keterangan-field" style="{{ $item->location_actual_status === 'x' ? '' : 'display: none;' }}">
                                                            <input type="text" name="location_actual_keterangan" 
                                                                value="{{ $item->location_actual_keterangan }}"
                                                                class="w-32 px-2 py-1 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                                                placeholder="Keterangan">
                                                        </div>
                                                        <button type="submit" class="inline-flex items-center px-2 py-1 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium rounded-md transition-colors duration-200">
                                                            Simpan
                                                        </button>
                                                    </div>
                                                </form>
                                            @else
                                                @if ($item->location_actual_status === 'centang')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">✓</span>
                                                @elseif ($item->location_actual_status === 'x')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        ✗ {{ $item->location_actual_keterangan ? '(' . $item->location_actual_keterangan . ')' : '' }}
                                                    </span>
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->item_number }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $item->description }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->manufacturer ?: '-' }}</td>
                                        <!-- Lot Serial Column -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if (Auth::user() && Auth::user()->role === 'admin')
                                                <form action="{{ route('admin.stock-opname.update-lot-serial', $item->id) }}" method="POST" class="flex items-center space-x-2">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" name="lot_serial" value="{{ $item->lot_serial }}"
                                                        class="w-36 px-2 py-1 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                                        placeholder="Lot/Serial">
                                                    <button type="submit" class="inline-flex items-center px-3 py-1 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md transition-colors duration-200">
                                                        Update
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-sm text-gray-900">{{ $item->lot_serial ?: '-' }}</span>
                                            @endif
                                        </td>
                                        <!-- Reference Column -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if (Auth::user() && Auth::user()->role === 'admin')
                                                <form action="{{ route('admin.stock-opname.update-keterangan', $item->id) }}" method="POST" class="flex items-center space-x-2">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" name="reference" value="{{ $item->reference }}" disabled
                                                        class="w-36 px-2 py-1 text-sm border border-gray-200 rounded-md bg-gray-100"
                                                        title="Reference dibaca dari Excel">
                                                </form>
                                            @else
                                                <span class="text-sm text-gray-900">{{ $item->reference ?: '-' }}</span>
                                            @endif
                                        </td>
                                        <!-- Expire Date Column -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if (Auth::user() && Auth::user()->role === 'admin')
                                                <form action="#" onsubmit="return false;" class="flex items-center space-x-2">
                                                    <input type="date" name="expired_date" value="{{ $item->expired_date ? \Carbon\Carbon::parse($item->expired_date)->format('Y-m-d') : '' }}" disabled
                                                        class="w-40 px-2 py-1 text-sm border border-gray-200 rounded-md bg-gray-100"
                                                        title="Expired Date dibaca dari Excel">
                                                </form>
                                            @else
                                                <span class="text-sm text-gray-900">{{ $item->expired_date ? \Carbon\Carbon::parse($item->expired_date)->format('d/m/Y') : '-' }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($item->quantity_on_hand, 5) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if (Auth::user() && Auth::user()->role === 'admin')
                                                <form action="{{ route('admin.stock-opname.update-stok', $item->id) }}"
                                                    method="POST" class="flex items-center space-x-2">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="number" name="stok_fisik" step="0.00001" min="0"
                                                        value="{{ $item->stok_fisik !== null ? rtrim(rtrim(number_format($item->stok_fisik, 5), '0'), '.') : '' }}"
                                                        class="w-28 px-2 py-1 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                                        placeholder="0.00000">
                                                    <button type="submit" class="inline-flex items-center px-3 py-1 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md transition-colors duration-200">
                                                        Update
                                                    </button>
                                                </form>
                                            @else
                                                @if ($item->stok_fisik !== null)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        {{ number_format($item->stok_fisik, 5) }}
                                                    </span>
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ isset($item->overmate_value) && $item->overmate_value !== null ? number_format($item->overmate_value, 5) : '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($item->stok_fisik !== null)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $item->selisih < 0 ? 'bg-red-100 text-red-800' : ($item->selisih > 0 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                    {{ $item->selisih > 0 ? '+' : '' }}{{ number_format($item->selisih, 5) }}
                                                </span>
                                            @else
                                                <span class="text-gray-400 text-sm">Input stok fisik dulu</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if (isset($item->overmate_value) && $item->overmate_value !== null && $item->stok_fisik !== null)
                                                @if ($item->masuk_kategori === 'Iya')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        Iya
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        Tidak
                                                    </span>
                                                @endif
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <!-- Keterangan Column -->
                                        <td class="px-6 py-4">
                                            @if (Auth::user() && Auth::user()->role === 'admin')
                                                <form action="{{ route('admin.stock-opname.update-keterangan', $item->id) }}" method="POST" class="flex items-center space-x-2">
                                                    @csrf
                                                    @method('PUT')
                                                    <textarea name="keterangan" rows="2" 
                                                        class="w-40 px-2 py-1 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 resize-none"
                                                        placeholder="Tambahkan keterangan...">{{ $item->keterangan }}</textarea>
                                                    <button type="submit" class="inline-flex items-center px-2 py-1 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium rounded-md transition-colors duration-200">
                                                        Simpan
                                                    </button>
                                                </form>
                                            @else
                                                <div class="text-sm text-gray-900 max-w-xs">
                                                    {{ $item->keterangan ?: '-' }}
                                                </div>
                                            @endif
                                        </td>
                                        <!-- History Tracing Column -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <button onclick="showHistory({{ $item->id }})" 
                                                class="inline-flex items-center px-3 py-1 bg-gray-600 hover:bg-gray-700 text-white text-xs font-medium rounded-md transition-colors duration-200">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                History
                                            </button>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                            @if (Auth::user() && Auth::user()->role === 'admin')
                                                <form action="{{ route('admin.stock-opname.row.destroy', $item->id) }}" method="POST" data-confirm="Hapus baris ini?" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md transition-colors duration-200">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    @if(method_exists($stockOpnames, 'links'))
                        <div class="px-6 py-4 border-t border-gray-200">
                            {{ $stockOpnames->onEachSide(1)->links('pagination::tailwind') }}
                        </div>
                    @endif
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 text-center py-12">
                    <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data stock opname</h3>
                    <p class="text-gray-500">Data belum tersedia untuk file ini</p>
                </div>
            @endif
        </div>
    </div>

    <!-- History Modal -->
    <div id="historyModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">History Tracing</h3>
                    <button onclick="closeHistoryModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="historyContent" class="max-h-96 overflow-y-auto">
                    <!-- History content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle keterangan field for location actual
        function toggleKeteranganField(selectElement) {
            var keteranganField = selectElement.closest('form').querySelector('.keterangan-field');
            if (selectElement.value === 'x') {
                keteranganField.style.display = '';
            } else {
                keteranganField.style.display = 'none';
                keteranganField.querySelector('input').value = '';
            }
        }

        // Show history modal
        function showHistory(itemId) {
            var modal = document.getElementById('historyModal');
            var content = document.getElementById('historyContent');
            
            // Show loading
            content.innerHTML = '<div class="text-center py-4"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600 mx-auto"></div><p class="mt-2 text-gray-600">Loading history...</p></div>';
            modal.classList.remove('hidden');

            // Fetch history data
            fetch('{{ url('/admin/stock-opname/history') }}/' + itemId)
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    if (data.length === 0) {
                        content.innerHTML = '<div class="text-center py-8 text-gray-500">Belum ada history untuk item ini</div>';
                        return;
                    }

                    var historyHtml = '<div class="space-y-4">';
                    for (var i = 0; i < data.length; i++) {
                        var history = data[i];
                        var date = new Date(history.created_at).toLocaleString('id-ID');
                        var fieldName = getFieldDisplayName(history.field_name);
                        
                        historyHtml += '<div class="border-l-4 border-indigo-500 pl-4 py-2">' +
                            '<div class="flex items-center justify-between">' +
                                '<div class="font-medium text-gray-900">' + fieldName + '</div>' +
                                '<div class="text-sm text-gray-500">' + date + '</div>' +
                            '</div>' +
                            '<div class="text-sm text-gray-600 mt-1">' +
                                '<strong>User:</strong> ' + history.user.name +
                            '</div>' +
                            '<div class="text-sm text-gray-600">' +
                                '<strong>Perubahan:</strong> ' +
                                '<span class="text-red-600">' + (history.old_value || 'kosong') + '</span> ' +
                                '→ ' +
                                '<span class="text-green-600">' + (history.new_value || 'kosong') + '</span>' +
                            '</div>' +
                        '</div>';
                    }
                    historyHtml += '</div>';
                    content.innerHTML = historyHtml;
                })
                .catch(function(error) {
                    console.error('Error:', error);
                    content.innerHTML = '<div class="text-center py-8 text-red-500">Error loading history</div>';
                });
        }

        // Close history modal
        function closeHistoryModal() {
            document.getElementById('historyModal').classList.add('hidden');
        }

        // Get field display name
        function getFieldDisplayName(fieldName) {
            var fieldNames = {
                'stok_fisik': 'Stok Fisik'
            };
            return fieldNames[fieldName] || fieldName;
        }

        // Close modal when clicking outside
        document.getElementById('historyModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeHistoryModal();
            }
        });

        function openAddRowModal() {
            var m = document.getElementById('addRowModal');
            if (m) m.classList.remove('hidden');
        }
        function closeAddRowModal() {
            var m = document.getElementById('addRowModal');
            if (m) m.classList.add('hidden');
        }

        // Client-side search & filters for the table
        (function () {
            var searchInput = document.getElementById('soSearchInput');
            var statusFilter = document.getElementById('soStatusFilter');
            var locFilter = document.getElementById('soLocFilter');
            var resultCount = document.getElementById('soResultCount');

            function getLocStatusFromRow(row) {
                // Admin view may have a select element
                var sel = row.querySelector('select[name="location_actual_status"]');
                if (sel) {
                    return sel.value || 'empty';
                }
                // Non-admin badges/text
                var cell = row.cells && row.cells[1];
                if (!cell) return 'empty';
                var t = cell.innerText || '';
                if (t.includes('✓')) return 'centang';
                if (t.includes('✗')) return 'x';
                return 'empty';
            }

            function getMasukKategoriFromRow(row) {
                var cell = row.cells && row.cells[12];
                if (!cell) return '';
                var t = (cell.innerText || '').toLowerCase();
                if (t.includes('iya')) return 'iya';
                if (t.includes('tidak')) return 'tidak';
                return '';
            }

            function filterTable() {
                var tbody = document.querySelector('table.min-w-full tbody');
                if (!tbody) return;
                var rows = tbody.querySelectorAll('tr');
                var q = (searchInput ? searchInput.value : '').trim().toLowerCase();
                var statusVal = statusFilter ? statusFilter.value : 'all';
                var locVal = locFilter ? locFilter.value : 'all';

                var visible = 0;
                rows.forEach(function (row) {
                    var rowText = (row.innerText || '').toLowerCase();
                    var matchSearch = q === '' || rowText.indexOf(q) !== -1;

                    var mk = getMasukKategoriFromRow(row);
                    var matchStatus = statusVal === 'all' || mk === statusVal;

                    var ls = getLocStatusFromRow(row);
                    var matchLoc = locVal === 'all' || ls === locVal;

                    var show = matchSearch && matchStatus && matchLoc;
                    row.style.display = show ? '' : 'none';
                    if (show) visible++;
                });
                if (resultCount) resultCount.textContent = visible;
            }

            if (searchInput) searchInput.addEventListener('input', filterTable);
            if (statusFilter) statusFilter.addEventListener('change', filterTable);
            if (locFilter) locFilter.addEventListener('change', filterTable);
            // Reset filters on load to prevent hidden rows after redirect
            window.addEventListener('load', function() {
                if (searchInput) searchInput.value = '';
                if (statusFilter) statusFilter.value = 'all';
                if (locFilter) locFilter.value = 'all';
                filterTable();
            });
        })();
    </script>
@endsection
