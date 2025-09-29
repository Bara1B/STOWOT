@extends('layouts.app')

@push('styles')
    <style>
        .tracking-modern-container {
            background: white;
            min-height: 100vh;
        }
        
        .tracking-modern-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 20px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }
        
        .tracking-modern-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
            pointer-events: none;
        }
        
        .wo-number-modern {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            letter-spacing: 2px;
        }
        
        .progress-card-modern {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }
        
        .progress-header-modern {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 2rem;
            border-bottom: 1px solid #e5e7eb;
            position: relative;
        }
        
        .timeline-modern-container {
            padding: 2rem;
            position: relative;
        }
        
        .timeline-item-modern {
            position: relative;
            margin-bottom: 2rem;
            display: flex;
            align-items: flex-start;
            gap: 1.5rem;
        }
        
        .timeline-item-modern:last-child {
            margin-bottom: 0;
        }
        
        .timeline-icon-modern {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 10;
            flex-shrink: 0;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .timeline-icon-modern.completed {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            animation: pulse-success 2s infinite;
        }
        
        .timeline-icon-modern.pending {
            background: linear-gradient(135deg, #e5e7eb 0%, #d1d5db 100%);
            color: #6b7280;
        }
        
        @keyframes pulse-success {
            0%, 100% {
                box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            }
            50% {
                box-shadow: 0 8px 24px rgba(16, 185, 129, 0.5);
            }
        }
        
        .timeline-content-modern {
            flex: 1;
            background: #f8fafc;
            border-radius: 16px;
            padding: 1.5rem;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .timeline-content-modern:hover {
            background: #f1f5f9;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        
        .timeline-content-modern.completed {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border-color: #bbf7d0;
        }
        
        .timeline-title-modern {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.75rem;
        }
        
        .timeline-date-modern {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }
        
        .timeline-date-modern.completed {
            color: #059669;
            font-weight: 600;
        }
        
        .timeline-date-modern.pending {
            color: #6b7280;
        }
        
        .timeline-notes-modern {
            background: white;
            border: 1px solid #e0e7ff;
            border-radius: 12px;
            padding: 1rem;
            margin: 1rem 0;
            border-left: 4px solid #6366f1;
        }
        
        .timeline-form-modern {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid #d1d5db;
            margin-top: 1rem;
        }
        
        .form-input-modern {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background: white;
        }
        
        .form-input-modern:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            transform: translateY(-1px);
        }
        
        .btn-modern {
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }
        
        .btn-success-modern {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }
        
        .btn-success-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
        }
        
        .btn-secondary-modern {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
        }
        
        .btn-secondary-modern:hover {
            background: #e5e7eb;
            transform: translateY(-1px);
        }
        
        .btn-disabled-modern {
            background: #f9fafb;
            color: #9ca3af;
            cursor: not-allowed;
            border: 1px solid #e5e7eb;
        }
        
        .back-btn-modern {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            color: #374151;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s ease;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .back-btn-modern:hover {
            background: #f9fafb;
            border-color: #9ca3af;
            color: #374151;
            text-decoration: none;
            transform: translateX(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .alert-modern {
            border-radius: 16px;
            border: none;
            padding: 1.25rem 1.5rem;
            margin-bottom: 2rem;
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
            border-left: 4px solid #10b981;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
        }
        
        .timeline-line-modern {
            position: absolute;
            left: 30px;
            top: 80px;
            bottom: -20px;
            width: 2px;
            background: linear-gradient(180deg, #e5e7eb 0%, #f3f4f6 100%);
            z-index: 1;
        }
        
        .timeline-item-modern:last-child .timeline-line-modern {
            display: none;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .tracking-modern-header {
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }
            
            .wo-number-modern {
                font-size: 1.75rem;
            }
            
            .timeline-modern-container {
                padding: 1rem;
            }
            
            .timeline-item-modern {
                flex-direction: column;
                gap: 1rem;
            }
            
            .timeline-icon-modern {
                width: 50px;
                height: 50px;
                align-self: flex-start;
            }
            
            .timeline-line-modern {
                display: none;
            }
        }
    </style>
@endpush

@section('content')
    <div class="tracking-modern-container">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <!-- Success Message -->
            @if (session('success'))
                <div class="alert-modern">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-semibold">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Back Button -->
            <a href="{{ route('dashboard') }}" class="back-btn-modern">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Dashboard
            </a>



            <!-- Modern Work Order Header -->
            <div class="tracking-modern-header">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0 relative z-10">
                    <div class="flex-1">
                        <!-- Status Badge -->
                        <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-800 mb-4">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            WO Diterima
                        </div>

                        <!-- Work Order Number -->
                        <h1 class="wo-number-modern">
                            {{ $workOrder->wo_number ?? 'N/A' }}
                        </h1>

                        <!-- Product Info -->
                        <div class="flex items-center text-white/90 text-lg">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            <span class="font-semibold">{{ $workOrder->output }}</span>
                        </div>
                    </div>

                    <!-- Due Date Card -->
                    <div class="bg-white/15 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                        <div class="text-sm text-white/80 mb-2 font-medium">Target Selesai</div>
                        <div class="text-2xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $workOrder->due_date->translatedFormat('d M Y') }}
                        </div>
                        <div class="text-sm text-white/70 mt-1">
                            {{ $workOrder->due_date->translatedFormat('l') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progress Tracking -->
            <div class="progress-card-modern">
                <div class="progress-header-modern">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Progres Pelacakan Work Order</h2>
                            <p class="text-gray-600 font-medium mt-1">Lacak setiap tahapan produksi dan update status sesuai progress</p>
                        </div>
                    </div>
                </div>

                <div class="timeline-modern-container">
                    @php
                        $stepsWithNotes = ['Selesai Timbang', 'Potong Stock', 'Released', 'Kirim BB', 'Kirim CPB/WO'];
                    @endphp

                    <div class="relative">
                        <!-- Timeline Line -->
                        <div class="timeline-line-modern"></div>
                        
                        @foreach ($workOrder->tracking as $index => $status)
                            <div class="timeline-item-modern">
                                <!-- Status Icon -->
                                <div class="timeline-icon-modern @if ($status->completed_at) completed @else pending @endif">
                                    @if ($status->completed_at)
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @else
                                        <span class="text-xl font-bold">{{ $index + 1 }}</span>
                                    @endif
                                </div>

                                <!-- Status Content -->
                                <div class="timeline-content-modern @if ($status->completed_at) completed @endif">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <h3 class="timeline-title-modern">
                                                {{ $status->status_name }}
                                            </h3>

                                            <!-- Date Display + Edit Controls -->
                                            <div class="timeline-date-modern @if ($status->completed_at) completed @else pending @endif">
                                                @if ($status->completed_at)
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <span id="display-date-{{ $status->id }}" class="font-semibold">
                                                        Selesai pada {{ \Carbon\Carbon::parse($status->completed_at)->translatedFormat('l, d M Y') }}
                                                    </span>
                                                    <button type="button" class="ml-3 text-indigo-600 hover:text-indigo-800 text-sm font-semibold edit-date-btn" data-id="{{ $status->id }}">
                                                        Edit
                                                    </button>

                                                    <!-- Inline Edit Form (hidden by default) -->
                                                    <form id="edit-form-{{ $status->id }}" method="POST" action="{{ route('work-orders.tracking.update-date', $status) }}" class="timeline-form-modern hidden mt-3">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700 mb-1">Ubah Tanggal Selesai:</label>
                                                                <input type="date" name="completed_date" class="form-input-modern" value="{{ optional($status->completed_at)->format('Y-m-d') }}" required>
                                                            </div>
                                                            @if (in_array($status->status_name, $stepsWithNotes))
                                                                <div>
                                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Ubah Keterangan:</label>
                                                                    <input type="text" name="notes" class="form-input-modern" value="{{ $status->notes }}" placeholder="Ubah keterangan...">
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="flex items-center gap-2 mt-3">
                                                            <button type="submit" class="btn-modern btn-success-modern">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                                </svg>
                                                                Simpan Perubahan
                                                            </button>
                                                            <button type="button" class="btn-modern btn-secondary-modern cancel-edit-btn" data-id="{{ $status->id }}">Batal</button>
                                                        </div>
                                                    </form>
                                                @else
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <span>Menunggu proses...</span>
                                                @endif
                                            </div>
                                            @if ($status->notes)
                                                <div class="timeline-notes-modern">
                                                    <div class="flex items-start">
                                                        <svg class="w-4 h-4 text-blue-600 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                                        </svg>
                                                        <div>
                                                            <p class="text-sm font-medium text-blue-800">Catatan:</p>
                                                            <p class="text-sm text-blue-700">{{ $status->notes }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Action Section -->
                                        <div class="flex-shrink-0">
                                            @if (!$status->completed_at)
                                                <form method="POST"
                                                    action="{{ route('work-orders.tracking.complete', $status) }}"
                                                    class="timeline-form-modern">
                                                    @csrf
                                                    <div class="space-y-3">
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai:</label>
                                                            <input type="date" name="completed_date" class="form-input-modern"
                                                                value="{{ date('Y-m-d') }}" required>
                                                        </div>
                                                        @if (in_array($status->status_name, $stepsWithNotes))
                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan:</label>
                                                                <input type="text" name="notes" class="form-input-modern"
                                                                    placeholder="Tambah keterangan...">
                                                            </div>
                                                        @endif
                                                        <button type="submit" class="btn-modern btn-success-modern w-full">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                            </svg>
                                                            Tandai Selesai
                                                        </button>
                                                    </div>
                                                </form>
                                            @else
                                                <div class="btn-modern btn-disabled-modern">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Sudah Selesai
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editDateButtons = document.querySelectorAll('.edit-date-btn');
                const cancelEditButtons = document.querySelectorAll('.cancel-edit-btn');

                editDateButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.dataset.id;
                        document.getElementById('display-date-' + id).classList.add('hidden');
                        document.getElementById('edit-form-' + id).classList.remove('hidden');
                    });
                });

                cancelEditButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.dataset.id;
                        document.getElementById('display-date-' + id).classList.remove('hidden');
                        document.getElementById('edit-form-' + id).classList.add('hidden');
                    });
                });
            });

            // Verification is now handled by VerificationManager
        </script>
    @endpush
@endsection
