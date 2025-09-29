@props(['workOrder'])

<div class="work-order-card">
    <!-- Header -->
    <div class="card-header">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                {{-- Nama Produk (Output) --}}
                <h3 class="card-title line-clamp-2">
                    {{ $workOrder->output ?? 'Nama Produk' }}
                </h3>

                {{-- Informasi Work Order --}}
                <div class="space-y-1">
                    <p class="card-subtitle">
                        <strong>Work Order:</strong> {{ $workOrder->wo_number }}
                    </p>
                    @if ($workOrder->id_number)
                        <p class="card-subtitle">
                            <strong>ID Number:</strong> {{ $workOrder->id_number }}
                        </p>
                    @endif
                    <p class="card-subtitle line-clamp-2">
                        <strong>Deskripsi:</strong> {{ $workOrder->output ?? 'Tidak ada deskripsi' }}
                    </p>
                </div>
            </div>

            {{-- Status Badge --}}
            <div class="ml-4 flex-shrink-0">
                @php
                    $isCompleted = $workOrder->status === 'Completed';
                    $isOverdue = !$isCompleted && $workOrder->due_date && $workOrder->due_date->isPast();
                @endphp
                @if ($isOverdue)
                    <span class="status-badge status-overdue">
                        Overdue
                    </span>
                @elseif ($isCompleted)
                    <span class="status-badge status-completed">
                        Completed
                    </span>
                @else
                    <span class="status-badge status-progress">
                        On Progress
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Details -->
    <div class="space-y-3 mb-4">
        {{-- Due Date --}}
        <div class="flex items-center text-sm text-gray-600">
            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                </path>
            </svg>
            <span class="truncate">
                Due: {{ $workOrder->due_date ? $workOrder->due_date->format('d M Y') : 'Not set' }}
            </span>
        </div>

        {{-- Created Date --}}
        <div class="flex items-center text-sm text-gray-600">
            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="truncate">
                Created: {{ $workOrder->created_at->format('d M Y') }}
            </span>
        </div>

        {{-- Diterima Date jika ada --}}
        @if ($workOrder->woDiterimaTracking && $workOrder->woDiterimaTracking->completed_at)
            <div class="flex items-center text-sm text-gray-600">
                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="truncate">
                    Diterima: {{ $workOrder->woDiterimaTracking->completed_at->format('d M Y') }}
                </span>
            </div>
        @endif
    </div>

    <!-- Progress Bar (if tracking exists) -->
    @if ($workOrder->tracking && $workOrder->tracking->count() > 0)
        <div class="progress-container">
            <div class="progress-text">
                <span>Progress</span>
            </div>
            <div class="progress-bar">
                @php
                    $progress =
                        $workOrder->tracking->count() > 0
                            ? ($workOrder->tracking->where('completed_at', '!=', null)->count() /
                                    $workOrder->tracking->count()) *
                                100
                            : 0;
                @endphp
                <div class="progress-fill" style="width: {{ $progress }}%"></div>
            </div>
        </div>
    @endif

    <!-- Actions -->
    <div class="card-actions">
        <a href="{{ route('public.tracking', $workOrder) }}" class="btn-view">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                </path>
            </svg>
            Lihat Progress
        </a>
        <span class="card-id">
            #{{ $workOrder->id }}
        </span>
    </div>
</div>
