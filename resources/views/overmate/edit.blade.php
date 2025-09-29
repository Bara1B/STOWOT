@extends('layouts.app')

@push('styles')
<link href="{{ asset('css/pages/overmate-form-clean.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="overmate-form-container">
    <div class="container">
        <!-- Breadcrumb -->
        <div class="breadcrumb-clean">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.data-master') }}">Data Master</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('overmate.index') }}">Master Data Overmate</a></li>
                    <li class="breadcrumb-item active">Edit Item</li>
                </ol>
            </nav>
        </div>

        <!-- Header -->
        <div class="overmate-form-header">
            <h1 class="overmate-form-title">
                <i class="fas fa-edit"></i>
                Edit Item Overmate
            </h1>
            <p class="overmate-form-subtitle">Perbarui informasi item {{ $overmate->item_number }}</p>
        </div>

        <!-- Form Section -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-section-clean">
                    <h2 class="form-section-title">Informasi Item</h2>
                    
                    @if ($errors->any())
                        <div class="alert-clean alert-error">
                            <i class="fas fa-exclamation-triangle alert-icon"></i>
                            <div class="alert-content">
                                <div class="alert-title">Terdapat kesalahan input</div>
                                <p class="alert-message">Silakan periksa kembali data yang Anda masukkan.</p>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('overmate.update', $overmate) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-grid-clean">
                            <div class="form-group-clean">
                                <label class="form-label-clean form-label-required">Item Number</label>
                                <input type="text" 
                                       name="item_number" 
                                       class="form-control-clean @error('item_number') form-control-error @enderror" 
                                       value="{{ old('item_number', $overmate->item_number) }}" 
                                       placeholder="Masukkan item number"
                                       required>
                                @error('item_number')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text-clean">Contoh: 14301102</div>
                            </div>

                            <div class="form-group-clean">
                                <label class="form-label-clean form-label-required">Manufacturer</label>
                                <input type="text" 
                                       name="manufactur" 
                                       class="form-control-clean @error('manufactur') form-control-error @enderror" 
                                       value="{{ old('manufactur', $overmate->manufactur) }}" 
                                       placeholder="Masukkan manufacturer"
                                       required>
                                @error('manufactur')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text-clean">Contoh: NOVACIN, ANON UVAN</div>
                            </div>

                            <div class="form-group-clean form-group-full">
                                <label class="form-label-clean form-label-required">Nama Bahan</label>
                                <input type="text" 
                                       name="nama_bahan" 
                                       class="form-control-clean @error('nama_bahan') form-control-error @enderror" 
                                       value="{{ old('nama_bahan', $overmate->nama_bahan) }}" 
                                       placeholder="Masukkan nama bahan"
                                       required>
                                @error('nama_bahan')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text-clean">Nama lengkap bahan/produk</div>
                            </div>

                            <div class="form-group-clean">
                                <label class="form-label-clean form-label-required">Overmate Qty</label>
                                <input type="number" 
                                       step="0.00001" 
                                       name="overmate_qty" 
                                       class="form-control-clean @error('overmate_qty') form-control-error @enderror" 
                                       value="{{ old('overmate_qty', $overmate->overmate_qty) }}" 
                                       placeholder="0.00000"
                                       required>
                                @error('overmate_qty')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text-clean">Quantity dengan 5 desimal</div>
                            </div>
                        </div>

                        <div class="form-actions-clean">
                            <a href="{{ route('overmate.index') }}" class="btn-secondary-clean">
                                <i class="fas fa-arrow-left"></i>
                                Kembali
                            </a>
                            <button type="submit" class="btn-primary-clean">
                                <i class="fas fa-save"></i>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
