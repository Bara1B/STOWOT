@extends('layouts.app')


@section('content')
    <div class="overmate-clean-container">
        <div class="container">
            <!-- Header Section -->
            <div class="overmate-header-clean">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="overmate-title-clean">Master Data Overmate</h1>
                    </div>
                    <div class="overmate-actions-clean">
                        @if (Auth::user() && Auth::user()->role === 'admin')
                            <a href="{{ route('overmate.create') }}" class="btn-add-clean">
                                <i class="fas fa-plus"></i>
                                Tambah
                            </a>
                        @endif
                        <span class="stats-badge-clean">Total: {{ number_format($overmates->total()) }} items</span>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Section -->
            <div class="search-section-clean">
                <form method="GET" action="{{ route('overmate.index') }}" class="search-form-clean">
                    <div class="form-group-clean">
                        <label for="search" class="form-label-clean">Search</label>
                        <input type="text" class="form-control-clean" id="search" name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari item number, nama bahan, atau manufacturer...">
                    </div>
                    <div class="form-group-clean">
                        <label for="item_number" class="form-label-clean">Item Number</label>
                        <select class="form-control-clean" id="item_number" name="item_number">
                            <option value="">Semua Item Number</option>
                            @foreach ($itemNumbers as $itemNumber)
                                <option value="{{ $itemNumber }}"
                                    {{ request('item_number') == $itemNumber ? 'selected' : '' }}>
                                    {{ $itemNumber }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group-clean">
                        <label for="manufactur" class="form-label-clean">Manufacturer</label>
                        <input type="text" class="form-control-clean" id="manufactur" name="manufactur"
                            value="{{ request('manufactur') }}" placeholder="Filter manufacturer...">
                    </div>
                    <div class="filter-buttons-clean">
                        <button type="submit" class="btn-filter-clean">
                            <i class="fas fa-search"></i>
                            Filter
                        </button>
                        <a href="{{ route('overmate.index') }}" class="btn-reset-clean" title="Reset Filter">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </form>
            </div>

            <!-- Results Section -->
            <div class="table-section-clean">
                <table class="table-clean">
                    <thead>
                        <tr>
                            <th class="col-number-clean">#</th>
                            <th class="col-item-number-clean">Item Number</th>
                            <th class="col-name-clean">Nama Bahan</th>
                            <th class="col-manufacturer-clean">Manufacturer</th>
                            <th class="col-qty-clean">Overmate Qty</th>
                            <th class="col-actions-clean">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($overmates as $index => $item)
                            <tr>
                                <td class="col-number-clean">{{ $overmates->firstItem() + $index }}</td>
                                <td class="col-item-number-clean">{{ $item->item_number }}</td>
                                <td class="col-name-clean">{{ $item->nama_bahan }}</td>
                                <td class="col-manufacturer-clean">{{ $item->manufactur }}</td>
                                <td class="col-qty-clean">{{ number_format($item->overmate_qty, 5) }}</td>
                                <td class="col-actions-clean">
                                    <div class="action-buttons-clean">
                                        @if (Auth::user() && Auth::user()->role === 'admin')
                                            <a href="{{ route('overmate.edit', $item->item_number) }}" 
                                               class="btn-action-clean btn-edit-clean" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('overmate.destroy', $item->item_number) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item {{ $item->item_number }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-clean btn-delete-clean" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty-state-clean">
                                    <div class="empty-icon-clean">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <h5 class="empty-title-clean">Tidak ada data ditemukan</h5>
                                    <p class="empty-text-clean">Coba ubah filter pencarian Anda</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if ($overmates->count() > 0)
                <div class="pagination-section-clean">
                    <div class="pagination-info-clean">
                        Menampilkan {{ $overmates->firstItem() }} - {{ $overmates->lastItem() }}
                        dari {{ number_format($overmates->total()) }} data
                        @if (request()->hasAny(['search', 'item_number', 'manufactur']))
                            <span class="badge bg-warning text-dark ms-2">Filtered</span>
                        @endif
                    </div>
                    <div class="pagination-links-clean">
                        {{ $overmates->withQueryString()->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

