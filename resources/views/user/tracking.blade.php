@extends('layouts.app')

@push('styles')
    <style>
        .tracking-container {
            background: white;
            min-height: 100vh;
        }
        
        .tracking-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .wo-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .wo-details {
            opacity: 0.9;
            font-size: 1.1rem;
        }
        
        .progress-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }
        
        .progress-header {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .timeline-modern {
            padding: 0;
            margin: 0;
            list-style: none;
        }
        
        .timeline-item {
            position: relative;
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #f1f5f9;
            transition: all 0.3s ease;
        }
        
        .timeline-item:last-child {
            border-bottom: none;
        }
        
        .timeline-item:hover {
            background: #f8fafc;
        }
        
        .timeline-item.completed {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        }
        
        .timeline-item.completed:hover {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
        }
        
        .timeline-icon {
            position: absolute;
            left: -12px;
            top: 50%;
            transform: translateY(-50%);
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
            z-index: 10;
        }
        
        .timeline-icon.pending {
            background: #e5e7eb;
            color: #6b7280;
            border: 3px solid white;
        }
        
        .timeline-icon.completed {
            background: #10b981;
            color: white;
            border: 3px solid white;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }
        
        .timeline-content {
            margin-left: 2rem;
        }
        
        .timeline-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }
        
        .timeline-date {
            font-size: 0.9rem;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }
        
        .timeline-date.completed {
            color: #059669;
            font-weight: 500;
        }
        
        .timeline-notes {
            font-size: 0.85rem;
            color: #6b7280;
            font-style: italic;
            margin-bottom: 1rem;
        }
        
        .timeline-form {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .form-input-modern {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }
        
        .form-input-modern:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        
        .btn-modern {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }
        
        .btn-success-modern {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }
        
        .btn-success-modern:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }
        
        .btn-disabled-modern {
            background: #f3f4f6;
            color: #9ca3af;
            cursor: not-allowed;
        }
        
        .back-btn-modern {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            color: #374151;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            margin-bottom: 2rem;
        }
        
        .back-btn-modern:hover {
            background: #f9fafb;
            border-color: #9ca3af;
            color: #374151;
            text-decoration: none;
            transform: translateX(-2px);
        }
        
        .timeline-line {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e5e7eb;
        }
        
        .alert-modern {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
            border-left: 4px solid #10b981;
        }
    </style>
@endpush

@section('content')
    <div class="tracking-container">
        <div class="container py-4">
            @if (session('success'))
                <div class="alert-modern">
                    <div class="d-flex align-items-center">
                        <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <a href="{{ route('dashboard') }}" class="back-btn-modern">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Dashboard
            </a>

            <!-- Modern Header Card -->
            <div class="tracking-header">
                <div class="d-flex align-items-center mb-3">
                    <div class="me-3">
                        <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="wo-number mb-0">{{ $workOrder->wo_number }}</h1>
                        <div class="wo-details">
                            <div class="d-flex flex-wrap gap-3">
                                <span><strong>Produk:</strong> {{ $workOrder->output }}</span>
                                <span><strong>Target:</strong> {{ $workOrder->due_date->translatedFormat('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progress Card -->
            <div class="progress-card">
                <div class="progress-header">
                    <div class="d-flex align-items-center">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <h3 class="mb-0 fw-bold text-gray-800">Progress Pelacakan Work Order</h3>
                    </div>
                    <p class="text-muted mb-0 mt-1">Lacak setiap tahapan produksi dan update status sesuai progress</p>
                </div>
                
                <div class="position-relative">
                    <div class="timeline-line"></div>
                    
                    @php
                        $stepsWithNotes = ['Selesai Timbang', 'Potong Stock', 'Released', 'Kirim BB', 'Kirim CPB/WO'];
                    @endphp

                    <ul class="timeline-modern">
                        @foreach ($workOrder->tracking as $index => $status)
                            <li class="timeline-item @if ($status->completed_at) completed @endif">
                                <div class="timeline-icon @if ($status->completed_at) completed @else pending @endif">
                                    @if ($status->completed_at)
                                        ✓
                                    @else
                                        {{ $index + 1 }}
                                    @endif
                                </div>
                                
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                                        <div class="flex-grow-1 me-3">
                                            <h4 class="timeline-title">{{ $status->status_name }}</h4>
                                            <div class="timeline-date @if ($status->completed_at) completed @endif">
                                                @if ($status->completed_at)
                                                    ✅ Selesai pada {{ \Carbon\Carbon::parse($status->completed_at)->translatedFormat('l, d M Y') }}
                                                @else
                                                    ⏳ Menunggu proses...
                                                @endif
                                            </div>
                                            @if ($status->notes)
                                                <div class="timeline-notes">
                                                    💬 {{ $status->notes }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="flex-shrink-0">
                                            @if (!$status->completed_at)
                                                <form method="POST"
                                                    action="{{ route('work-orders.tracking.complete', $status->id) }}"
                                                    class="timeline-form">
                                                    @csrf
                                                    <input type="date" name="completed_date" class="form-input-modern"
                                                        value="{{ date('Y-m-d') }}" required style="min-width: 140px;">
                                                    @if (in_array($status->status_name, $stepsWithNotes))
                                                        <input type="text" name="notes" class="form-input-modern"
                                                            placeholder="Tambah keterangan..." style="min-width: 180px;">
                                                    @endif
                                                    <button type="submit" class="btn-modern btn-success-modern">
                                                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-1">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                        Selesai
                                                    </button>
                                                </form>
                                            @else
                                                <button class="btn-modern btn-disabled-modern" disabled>
                                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Sudah Selesai
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
