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

        /* Ensure proper container sizing */
        .work-order-container {
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

        /* Ensure header gradient is visible */
        .form-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            position: relative;
            z-index: 5;
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

        /* Fix for potential layout issues */
        .max-w-4xl {
            max-width: 56rem;
            width: 100%;
        }

        /* Ensure buttons are always visible */
        .action-buttons {
            position: relative;
            z-index: 10;
            margin-top: 2rem;
            padding-top: 2rem;
        }
    </style>
@endpush

@section('content')
    <div class="work-order-container">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white drop-shadow-lg">Tambah Work Order</h1>
                            <p class="text-white/90 mt-1 drop-shadow-md font-medium">Buat work order baru untuk produksi</p>
                        </div>
                    </div>
                </div>
                
                <!-- Form Content -->
                <div class="form-container p-8">
                    <form method="POST" action="{{ route('work-orders.store') }}" class="space-y-6">
                        @csrf

                        <!-- Product Selection Section -->
                        <div class="form-section bg-gray-50 rounded-xl p-6 space-y-6">
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
                                <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 bg-white" 
                                        id="product_kode" name="product_kode" required>
                                    <option value="" selected disabled>-- Pilih Kode Produk --</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->kode }}" data-item-number="{{ $product->item_number }}">
                                            {{ $product->kode }} - {{ $product->description }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Product Name (Auto-filled) -->
                            <div>
                                <label for="output" class="block text-sm font-medium text-gray-700 mb-2">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                        Nama Produk (Output)
                                    </span>
                                </label>
                                <input type="text" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-600 cursor-not-allowed" 
                                       id="output" name="output" readonly 
                                       placeholder="Nama produk akan muncul otomatis...">
                            </div>
                        </div>

                        <!-- Work Order Details Section -->
                        <div class="form-section bg-purple-50 rounded-xl p-6 space-y-6">
                            <div class="flex items-center mb-4">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">Detail Work Order</h3>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Sequence Number -->
                                <div>
                                    <label for="sequence" class="block text-sm font-medium text-gray-700 mb-2">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                            </svg>
                                            Nomor Urut WO
                                        </span>
                                    </label>
                                    <input type="text" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors duration-200 @error('sequence') border-red-300 @enderror" 
                                           id="sequence" name="sequence" required maxlength="3" 
                                           placeholder="Contoh: 58">
                                    @error('sequence')
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
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors duration-200 @error('due_date') border-red-300 @enderror" 
                                           id="due_date" name="due_date" required>
                                    @error('due_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- WO Number Preview -->
                        <div class="form-section bg-green-50 rounded-xl p-6">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">Preview Nomor WO</h3>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-green-200">
                                <p class="text-sm text-gray-600 mb-2">Nomor Work Order yang akan dibuat:</p>
                                <p class="text-xl font-mono font-bold text-green-700" id="wo_preview">-</p>
                            </div>
                        </div>

                        <!-- Hidden Input -->
                        <input type="hidden" name="wo_number" id="wo_number">
                        
                        <!-- Action Buttons -->
                        <div class="action-buttons flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200">
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
                                    class="px-6 py-3 btn-gradient text-white rounded-lg hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed" 
                                    id="submit_button" disabled>
                                <span class="flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Simpan Work Order
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil semua elemen form yang kita butuhin
            const productKodeSelect = document.getElementById('product_kode');
            const outputInput = document.getElementById('output');
            const sequenceInput = document.getElementById('sequence');
            const finalWoDisplay = document.getElementById('final_wo_display');
            const woNumberInput = document.getElementById('wo_number');
            const submitButton = document.getElementById('submit_button');

            // Fungsi buat update Nomor WO final
            function updateFinalWoNumber() {
                const selectedKode = productKodeSelect.value;
                const sequence = sequenceInput.value;
                const selectedOption = productKodeSelect.options[productKodeSelect.selectedIndex];
                const woPreview = document.getElementById('wo_preview');

                // Cuma jalanin kalo kode produk dan nomor urut udah diisi
                if (selectedKode && sequence && selectedOption) {
                    const itemNumber = selectedOption.dataset.itemNumber;
                    const year = '86';
                    const suffix = itemNumber.slice(-1);

                    // Pastiin sequence selalu 3 digit (format penyimpanan), input user tidak wajib 0 di depan
                    const paddedSequence = String(sequence).padStart(3, '0');

                    const finalWoNumber = `${year}${selectedKode}${paddedSequence}${suffix}`;
                    woNumberInput.value = finalWoNumber;
                    woPreview.textContent = finalWoNumber;
                    woPreview.classList.remove('text-gray-400');
                    woPreview.classList.add('text-green-700');
                    submitButton.disabled = false; // Aktifin tombol simpan
                } else {
                    woNumberInput.value = '';
                    woPreview.textContent = 'Lengkapi form untuk melihat preview';
                    woPreview.classList.remove('text-green-700');
                    woPreview.classList.add('text-gray-400');
                    submitButton.disabled = true; // Non-aktifin kalo belum lengkap
                }
            }

            // Event listener buat dropdown produk
            productKodeSelect.addEventListener('change', async function() {
                const selectedKode = this.value;
                if (!selectedKode) {
                    outputInput.value = '';
                    updateFinalWoNumber();
                    return;
                }

                outputInput.value = 'Memuat...';

                try {
                    const response = await fetch(`/api/product/${selectedKode}`);
                    if (!response.ok) throw new Error('Produk tidak ditemukan.');

                    const product = await response.json();
                    outputInput.value = product.description;

                    // Panggil fungsi update setelah nama produk terisi
                    updateFinalWoNumber();
                } catch (error) {
                    console.error(error);
                    outputInput.value = 'Error';
                }
            });

            // Event listener buat input nomor urut manual
            sequenceInput.addEventListener('input', function() {
                // Hanya izinkan angka dan batasi 3 digit saat menyimpan, namun input boleh tanpa 0 depan
                this.value = this.value.replace(/[^0-9]/g, '').slice(0, 3);
                updateFinalWoNumber();
            });
        });
    </script>
@endpush
