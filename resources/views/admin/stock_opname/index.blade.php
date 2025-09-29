@extends('layouts.app')

@section('content')
    <div class="w-full px-6 py-4">
        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-1">Stock Opname System</h2>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                    </svg>
                </span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                    </svg>
                </span>
            </div>
        @endif

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Left Column: Info & File List -->
            <div class="space-y-4">
                <!-- Info Section -->
                <div class="bg-white rounded-lg shadow-sm border">
                    <div class="bg-blue-500 text-white px-4 py-3 rounded-t-lg">
                        <h6 class="text-sm font-semibold mb-0">Cara Kerja Stock Opname</h6>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm mb-2"><span class="font-semibold">Upload File:</span> Pilih file Excel (.xlsx) dengan format yang sesuai</p>
                                <p class="text-sm mb-2"><span class="font-semibold">Import Data:</span> Klik "Import Data" untuk memproses file</p>
                            </div>
                            <div>
                                <p class="text-sm mb-2"><span class="font-semibold">Input Stok Fisik:</span> Masukkan stok fisik aktual via web</p>
                                <p class="text-sm mb-2"><span class="font-semibold">Lihat Hasil:</span> Sistem akan menghitung selisih dan kategori</p>
                            </div>
                        </div>
                        
                        <!-- Statistics -->
                        @php
                            $countUploaded = $uploadedFiles->where('status', 'uploaded')->count();
                            $countImported = $uploadedFiles->where('status', 'imported')->count();
                            $totalFiles = $uploadedFiles->count();
                            $lastImportedAt = optional($uploadedFiles->where('status', 'imported')->sortByDesc('created_at')->first())->created_at;
                        @endphp
                        
                        <div class="grid grid-cols-4 gap-3 mt-4">
                            <div class="text-center border rounded-lg p-3 bg-yellow-50">
                                <div class="text-lg font-bold text-yellow-700 mb-0">{{ $countUploaded }}</div>
                                <small class="text-xs text-gray-600">Uploaded</small>
                            </div>
                            <div class="text-center border rounded-lg p-3 bg-blue-50">
                                <div class="text-lg font-bold text-blue-700 mb-0">{{ $countImported }}</div>
                                <small class="text-xs text-gray-600">Imported</small>
                            </div>
                            <div class="text-center border rounded-lg p-3">
                                <div class="text-lg font-bold mb-0">{{ $totalFiles }}</div>
                                <small class="text-xs text-gray-600">Total Files</small>
                            </div>
                            <div class="text-center border rounded-lg p-3">
                                <div class="text-lg font-bold mb-0">{{ $lastImportedAt ? $lastImportedAt->format('d/m') : '—' }}</div>
                                <small class="text-xs text-gray-600">Terakhir Import</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- File List Section -->
                <div class="bg-white rounded-lg shadow-sm border">
                    <div class="bg-green-500 text-white px-4 py-3 rounded-t-lg">
                        <h6 class="text-sm font-semibold mb-0 flex items-center">
                            <i class="fas fa-folder-open mr-2"></i>Daftar File Stock Opname
                        </h6>
                    </div>
                    <div class="p-4">
                        @if ($uploadedFiles->count() > 0)
                            @foreach ($uploadedFiles as $file)
                                <div class="border rounded-lg p-3 mb-3">
                                    <div class="flex items-start">
                                        <div class="mr-3 flex-shrink-0 mt-1">
                                            <i class="fas fa-circle text-green-500 text-xs"></i>
                                        </div>
                                        <div class="mr-4 flex-shrink-0">
                                            @if ($file->status === 'uploaded')
                                                <i class="fas fa-file-excel text-yellow-500 text-2xl"></i>
                                            @elseif ($file->status === 'imported')
                                                <i class="fas fa-file-excel text-green-500 text-2xl"></i>
                                            @else
                                                <i class="fas fa-file text-gray-500 text-2xl"></i>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <div class="font-semibold text-gray-800 break-words">{{ $file->original_name }}</div>
                                            <div class="text-sm text-gray-500 mt-1">{{ $file->created_at->format('d/m/Y H:i') }} • {{ number_format($file->file_size / 1024, 1) }} KB</div>
                                            <div class="mt-2">
                                                @if ($file->status === 'uploaded')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Sudah Diupload</span>
                                                @elseif ($file->status === 'imported')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Sudah Diimport</span>
                                                @endif
                                            </div>
                                            <div class="mt-3 flex flex-wrap gap-2">
                                                @if ($file->status === 'uploaded')
                                                    <form action="{{ route('admin.stock-opname.import-data', $file->id) }}" 
                                                          method="POST" 
                                                          onsubmit="return confirm('Import data dari file ini?');"
                                                          class="inline-block">
                                                        @csrf
                                                        <button type="submit" class="inline-flex items-center px-3 py-2 text-xs font-medium rounded-md text-white bg-yellow-700 hover:bg-yellow-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors duration-200 whitespace-nowrap">
                                                            <i class="fas fa-database mr-1"></i>
                                                            Import Data
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.stock-opname.delete', $file->id) }}" 
                                                          method="POST" 
                                                          onsubmit="return confirm('Hapus file ini beserta datanya?');"
                                                          class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="inline-flex items-center px-3 py-2 text-xs font-medium rounded-md text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200 whitespace-nowrap">
                                                            <i class="fas fa-trash mr-1"></i>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                @elseif ($file->status === 'imported')
                                                    <a href="{{ route('admin.stock-opname.show-data', $file->id) }}" class="inline-flex items-center px-3 py-2 text-xs font-medium rounded-md text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 whitespace-nowrap">
                                                        <i class="fas fa-eye mr-1"></i>
                                                        Lihat Data
                                                    </a>
                                                    <a href="{{ route('admin.stock-opname.export-data', $file->id) }}" class="inline-flex items-center px-3 py-2 text-xs font-medium rounded-md text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200 whitespace-nowrap">
                                                        <i class="fas fa-file-excel mr-1"></i>
                                                        Export Excel
                                                    </a>
                                                    <form action="{{ route('admin.stock-opname.delete', $file->id) }}" 
                                                          method="POST" 
                                                          onsubmit="return confirm('Hapus file ini beserta datanya?');"
                                                          class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="inline-flex items-center px-3 py-2 text-xs font-medium rounded-md text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200 whitespace-nowrap">
                                                            <i class="fas fa-trash mr-1"></i>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="mt-4">
                                <small class="text-gray-500">Menampilkan 1 - {{ $uploadedFiles->count() }} dari {{ $uploadedFiles->count() }} hasil</small>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-folder-open text-4xl text-gray-400 mb-4"></i>
                                <h5 class="text-lg font-semibold text-gray-700 mb-2">Belum ada file yang diupload</h5>
                                <p class="text-gray-500">Upload file Excel pertama Anda untuk memulai proses stock opname.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: Upload Section -->
            <div>
                <div class="bg-white rounded-lg shadow-sm border">
                    <div class="bg-cyan-500 text-white px-4 py-3 rounded-t-lg">
                        <h6 class="text-sm font-semibold mb-0">Upload File Excel</h6>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-700 mb-4">Upload file Excel (.xlsx) untuk memulai proses stock opname. Setelah upload, klik "Import Data" untuk memproses file.</p>
                        
                        @if (Route::has('stock-opname.download-template'))
                            <div class="mb-4">
                                <a href="{{ route('stock-opname.download-template') }}" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <i class="fas fa-download mr-2"></i> Download Template
                                </a>
                            </div>
                        @endif

                        <form action="{{ route('admin.stock-opname.upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="file" class="block text-sm font-medium text-gray-700 mb-2">Pilih File Excel</label>
                                <input type="file" 
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @if ($errors && $errors->has('file')) border-red-300 @endif" 
                                       id="file" 
                                       name="file" 
                                       accept=".xlsx,.xls" 
                                       required>
                                @if ($errors && $errors->has('file'))
                                    <p class="mt-1 text-sm text-red-600">{{ $errors->first('file') }}</p>
                                @endif
                                <p class="mt-1 text-sm text-gray-500">
                                    File terpilih: <span id="chosen-file-name">Belum ada</span>
                                </p>
                            </div>

                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                                <h6 class="flex items-center text-sm font-semibold text-blue-800 mb-2">
                                    <i class="fas fa-info-circle mr-2"></i> Format Header Excel yang diharapkan:
                                </h6>
                                <p class="text-xs text-blue-700 mb-3">No, Location System, Location Actual, Item Number, Description, UM, Lot/Serial, Reference, Quantity On Hand, Expire Date, Stock Fisik, Selisih, Overmate, Masuk</p>
                                
                                <h6 class="flex items-center text-sm font-semibold text-blue-800 mb-2">
                                    <i class="fas fa-exclamation-triangle mr-2"></i> Catatan Penting:
                                </h6>
                                <ul class="text-xs text-blue-700 list-disc list-inside space-y-1">
                                    <li>Upload file akan mengganti semua data stock opname yang ada</li>
                                    <li>Pastikan format header sesuai dengan yang diperlukan</li>
                                    <li>Maksimal ukuran file: 10MB</li>
                                    <li>Data akan di-join dengan data overmate berdasarkan item_number</li>
                                    <li>Kolom "Stock Fisik": kosongkan untuk input manual via web</li>
                                    <li>Kolom "Selisih", "Overmate", "Masuk": akan diisi otomatis oleh sistem</li>
                                </ul>
                            </div>

                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-upload mr-2"></i> Upload
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function() {
            const input = document.getElementById('file');
            const chosen = document.getElementById('chosen-file-name');
            if (!input) return;
            input.addEventListener('change', function() {
                const file = this.files && this.files[0];
                if (!file) {
                    if (chosen) chosen.textContent = 'Belum ada';
                    return;
                }
                const name = file.name.toLowerCase();
                const validExt = name.endsWith('.xlsx') || name.endsWith('.xls');
                const maxSize = 10 * 1024 * 1024; // 10MB
                if (!validExt) {
                    alert('Hanya file Excel (.xlsx atau .xls) yang diperbolehkan.');
                    this.value = '';
                    if (chosen) chosen.textContent = 'Belum ada';
                    return;
                }
                if (file.size > maxSize) {
                    alert('Ukuran file melebihi 10MB.');
                    this.value = '';
                    if (chosen) chosen.textContent = 'Belum ada';
                    return;
                }
                if (chosen) chosen.textContent = file.name;
            });
        })();
    </script>
@endpush
