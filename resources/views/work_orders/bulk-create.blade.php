@extends('layouts.app')

@push('styles')
    <style>
        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        
        .btn-gradient:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .info-card {
            background: linear-gradient(135deg, #e0f2fe 0%, #f3e5f5 100%);
            border: 1px solid rgba(156, 163, 175, 0.2);
        }

        /* Ensure proper container sizing */
        .bulk-work-order-container {
            min-height: 100vh;
            padding: 2rem 0;
            position: relative;
            z-index: 2;
            overflow: visible;
        }

        /* Glass morphism effect for form */
        .glass-form {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        /* Ensure form sections are visible */
        .form-section {
            position: relative;
            z-index: 3;
            margin-bottom: 1.5rem;
        }

        /* Ensure proper form layout */
        .form-container {
            max-width: none;
            width: 100%;
            overflow: visible;
        }

        /* Ensure buttons are always visible */
        .action-buttons {
            position: relative;
            z-index: 10;
            margin-top: 2rem;
            padding-top: 2rem;
        }

        /* Ensure header gradient is visible */
        .form-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            position: relative;
            z-index: 5;
        }
    </style>
@endpush

@section('content')
    <div class="bulk-work-order-container">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('dashboard') }}" 
                   class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-200 shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>
            
            <!-- Main Card -->
            <div class="glass-form rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <!-- Header -->
                <div class="form-header px-8 py-6 relative">
                    <!-- Background overlay for better text visibility -->
                    <div class="absolute inset-0 bg-black/10"></div>
                    <div class="flex items-center relative z-10">
                        <div class="w-12 h-12 bg-white/30 rounded-xl flex items-center justify-center mr-4 backdrop-blur-sm border border-white/20">
                            <svg class="w-6 h-6 text-white drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white drop-shadow-lg">Tambah Work Order (Borongan)</h1>
                            <p class="text-white/90 mt-1 drop-shadow-md font-medium">Buat beberapa work order sekaligus dengan efisien</p>
                        </div>
                    </div>
                </div>
                
                <!-- Info Banner -->
                <div class="info-card mx-8 mt-6 rounded-xl p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-gray-700">
                                <span class="font-medium">Bulk Creation:</span> Gunakan form ini untuk membuat beberapa Work Order sekaligus untuk produk dan due date yang sama. Sistem akan membuat nomor urut secara berurutan.
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Form Content -->
                <div class="p-8">
                    <form action="{{ route('work-orders.bulk-store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Product Selection Section -->
                        <div class="bg-gray-50 rounded-xl p-6 space-y-6">
                            <div class="flex items-center mb-4">
                                <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">Informasi Produk</h3>
                            </div>
                            
                            <!-- Product Code Dropdown -->
                            <div>
                                <label for="product_kode" class="block text-sm font-medium text-gray-700 mb-2">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                        </svg>
                                        Kode Produk
                                    </span>
                                </label>
                                <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 bg-white @error('product_kode') border-red-300 @enderror" 
                                        id="product_kode" name="product_kode" required>
                                    <option value="" selected disabled>-- Pilih Kode Produk --</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->kode }}"
                                            {{ old('product_kode') == $product->kode ? 'selected' : '' }}>
                                            {{ $product->kode }} - {{ $product->description }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_kode')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Due Date -->
                            <div>
                                <label for="due_date" class="block text-sm font-medium text-gray-700 mb-2">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Due Date
                                    </span>
                                </label>
                                <input type="date" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 @error('due_date') border-red-300 @enderror" 
                                       id="due_date" name="due_date" value="{{ old('due_date') }}" required>
                                @error('due_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Bulk Generation Settings -->
                        <div class="bg-orange-50 rounded-xl p-6 space-y-6">
                            <div class="flex items-center mb-4">
                                <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">Pengaturan Bulk Generation</h3>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Start Sequence -->
                                <div>
                                    <label for="start_sequence" class="block text-sm font-medium text-gray-700 mb-2">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                            Mulai dari Nomor Urut
                                        </span>
                                    </label>
                                    <input type="number" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors duration-200 @error('start_sequence') border-red-300 @enderror" 
                                           id="start_sequence" name="start_sequence" value="{{ old('start_sequence') }}" 
                                           placeholder="Contoh: 58" min="1" required>
                                    @error('start_sequence')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Quantity -->
                                <div>
                                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                            </svg>
                                            Jumlah WO yang Dibuat
                                        </span>
                                    </label>
                                    <input type="number" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors duration-200 @error('quantity') border-red-300 @enderror" 
                                           id="quantity" name="quantity" value="{{ old('quantity', 1) }}" 
                                           min="1" max="50" required>
                                    @error('quantity')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Preview Info -->
                            <div class="bg-white rounded-lg p-4 border border-orange-200">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg class="w-5 h-5 text-orange-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-700">
                                            <span class="font-medium">Contoh:</span> Jika mulai dari nomor 58 dan membuat 3 WO, sistem akan membuat WO dengan nomor urut: 58, 59, 60
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('dashboard') }}" 
                               class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200 text-center">
                                <span class="flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Batal
                                </span>
                            </a>
                            <button type="submit" 
                                    class="px-6 py-3 btn-gradient text-white rounded-lg hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200">
                                <span class="flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    Generate Work Orders
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
