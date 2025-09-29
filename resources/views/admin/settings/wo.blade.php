@extends('layouts.app')

@section('title', 'Pengaturan Sistem')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-900">Pengaturan Sistem</h1>
                <p class="text-gray-500">Konfigurasi sistem dan fitur aplikasi</p>
            </div>

            <div class="bg-white rounded-lg shadow border border-gray-100">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-medium text-gray-900">Pengaturan Sistem</h2>
                    <a href="{{ route('admin.home') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>

                <div class="p-6">
                    @if (session('success'))
                        <div class="mb-4 rounded-md bg-green-50 p-4 border border-green-200 text-green-800">
                            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4 rounded-md bg-red-50 p-4 border border-red-200 text-red-800">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('settings.update') }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Prefix -->
                        <div>
                            <label for="wo_prefix" class="block text-sm font-medium text-gray-700">Prefix Nomor</label>
                            <div class="mt-1 flex rounded-md shadow-sm max-w-xs">
                                <input type="text" id="wo_prefix" name="wo_prefix"
                                       value="{{ $settings['wo_prefix'] ?? '86' }}" required maxlength="10"
                                       class="flex-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-gray-900"
                                       placeholder="86">
                            </div>
                            <p class="mt-2 text-sm text-gray-500" id="prefixExample">
                                Contoh: {{ $settings['wo_prefix'] ?? '86' }}002001T
                            </p>
                        </div>

                        <div class="grid grid-cols-1 gap-4">
                            <!-- Work Order Tracking -->
                            <label class="flex items-start p-4 border border-gray-200 rounded-lg cursor-pointer hover:border-blue-300">
                                <input type="checkbox" id="wo_tracking_enabled" name="wo_tracking_enabled" value="1"
                                       {{ $settings['wo_tracking_enabled'] ? 'checked' : '' }}
                                       class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">Work Order Tracking</div>
                                    <div class="text-sm text-gray-500">Mengaktifkan fitur tracking progress work order</div>
                                </div>
                            </label>

                            <!-- Stock Opname -->
                            <label class="flex items-start p-4 border border-gray-200 rounded-lg cursor-pointer hover:border-blue-300">
                                <input type="checkbox" id="stock_opname_enabled" name="stock_opname_enabled" value="1"
                                       {{ $settings['stock_opname_enabled'] ? 'checked' : '' }}
                                       class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">Stock Opname</div>
                                    <div class="text-sm text-gray-500">Mengaktifkan fitur stock opname dan inventory</div>
                                </div>
                            </label>

                            <!-- Overmate -->
                            <label class="flex items-start p-4 border border-gray-200 rounded-lg cursor-pointer hover:border-blue-300">
                                <input type="checkbox" id="overmate_enabled" name="overmate_enabled" value="1"
                                       {{ $settings['overmate_enabled'] ? 'checked' : '' }}
                                       class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">Overmate</div>
                                    <div class="text-sm text-gray-500">Mengaktifkan fitur overmate dan material management</div>
                                </div>
                            </label>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <button type="button" id="btnReset" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50">
                                <i class="fas fa-undo mr-2"></i>Reset ke Default
                            </button>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.home') }}" class="px-4 py-2 text-sm font-medium rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50">Batal</a>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <i class="fas fa-save mr-2"></i>Simpan Pengaturan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const prefixInput = document.getElementById('wo_prefix');
            const example = document.getElementById('prefixExample');
            if (prefixInput && example) {
                prefixInput.addEventListener('input', function () {
                    const prefix = this.value || '86';
                    example.textContent = 'Contoh: ' + prefix + '002001T';
                });
            }
            const btnReset = document.getElementById('btnReset');
            if (btnReset) {
                btnReset.addEventListener('click', function () {
                    if (confirm('Apakah Anda yakin ingin mereset semua pengaturan ke default?')) {
                        window.location.href = '{{ route('settings.reset') }}';
                    }
                });
            }
        })();
    </script>
@endsection
