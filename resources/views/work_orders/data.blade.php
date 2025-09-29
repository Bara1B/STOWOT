@extends('layouts.app')

@section('content')
    <div class="work-order-data-clean-container">
        <div class="container">
            <!-- Header Section -->
            <div class="work-order-data-header-clean">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="work-order-data-title-clean">Work Order Data</h1>
                    </div>
                    <div class="work-order-data-actions-clean">
                        @if (Auth::user() && Auth::user()->role === 'admin')
                            <a href="{{ route('work-orders.data.create') }}" class="btn-add-clean">
                                <i class="fas fa-plus"></i>
                                Tambah
                            </a>
                        @endif
                        <span class="stats-badge-clean">Total: {{ number_format($products->total()) }} items</span>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Section -->
            <div class="search-section-clean">
                <form method="GET" action="{{ route('work-orders.data.index') }}" class="search-form-clean">
                    <div class="form-group-clean">
                        <label for="item_number" class="form-label-clean">Item Number</label>
                        <input type="text" class="form-control-clean" id="item_number" name="item_number"
                            value="{{ request('item_number') }}" placeholder="Cari item number...">
                    </div>
                    <div class="form-group-clean">
                        <label for="kode" class="form-label-clean">Kode</label>
                        <input type="text" class="form-control-clean" id="kode" name="kode"
                            value="{{ request('kode') }}" placeholder="Cari kode...">
                    </div>
                    <div class="form-group-clean">
                        <label for="description" class="form-label-clean">Description</label>
                        <input type="text" class="form-control-clean" id="description" name="description"
                            value="{{ request('description') }}" placeholder="Cari description...">
                    </div>
                    <div class="filter-buttons-clean">
                        <button type="submit" class="btn-filter-clean">
                            <i class="fas fa-search"></i>
                            Filter
                        </button>
                        <a href="{{ route('work-orders.data.index') }}" class="btn-reset-clean" title="Reset Filter">
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
                            <th>Item Number</th>
                            <th>Kode</th>
                            <th>Description</th>
                            <th>Description 2</th>
                            <th>Group</th>
                            @if (Auth::user() && Auth::user()->role === 'admin')
                                <th class="col-actions-clean">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $p)
                            <tr>
                                <td><span class="col-item-number-clean">{{ $p->item_number }}</span></td>
                                <td class="col-kode-clean">{{ $p->kode }}</td>
                                <td class="col-description-clean">{{ $p->description }}</td>
                                <td class="col-description2-clean">{{ $p->uom }}</td>
                                <td class="col-group-clean">{{ $p->group }}</td>
                                @if (Auth::user() && Auth::user()->role === 'admin')
                                    <td class="col-actions-clean">
                                        <div class="action-buttons-clean">
                                            <a href="{{ route('work-orders.data.edit', $p) }}" 
                                               class="btn-action-clean btn-edit-clean" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('work-orders.data.destroy', $p) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-clean btn-delete-clean" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
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
            
            @if ($products->count() > 0)
                <div class="pagination-section-clean">
                    <div class="pagination-info-clean">
                        Menampilkan {{ $products->firstItem() }} - {{ $products->lastItem() }}
                        dari {{ number_format($products->total()) }} data
                        @if (request()->hasAny(['item_number', 'kode', 'description']))
                            <span class="badge bg-warning text-dark ms-2">Filtered</span>
                        @endif
                    </div>
                    <div class="pagination-links-clean">
                        {{ $products->withQueryString()->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
