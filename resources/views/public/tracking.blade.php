@extends('layouts.public')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Header Section -->
        <div class="bg-white/70 backdrop-blur py-8 border-b border-gray-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Progress Tracking</h1>
                <p class="text-lg text-gray-600 mb-2">
                    Monitor progress dan status Work Order secara detail.
                    <span class="text-blue-600 font-medium">Hanya untuk informasi, tidak bisa diedit.</span>
                </p>
            </div>
        </div>

        <!-- Work Order Details -->
        <div class="py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Work Order Info Card -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8 shadow-md">
                    <div class="flex items-start justify-between mb-6">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-4">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded text-sm font-medium bg-blue-100 text-blue-800">
                                    On Progress
                                </span>
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded text-sm font-medium bg-blue-100 text-blue-800">
                                    WO: {{ $workOrder->wo_number ?? '8600200TT' }}
                                </span>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $workOrder->output ?? 'Antimo Tablet' }}
                            </h2>
                            <p class="text-gray-600 mb-4">Deskripsi: {{ $workOrder->output ?? 'Antimo Tablet' }}</p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="font-medium">Due Date:</span>
                                    {{ $workOrder->due_date ? $workOrder->due_date->format('d M Y') : '13 Sep 2025' }}
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="font-medium">Created:</span>
                                    {{ $workOrder->created_at ? $workOrder->created_at->format('d M Y H:i') : '12 Sep 2025 08:43' }}
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="font-medium">Diterima:</span>
                                    {{ $workOrder->created_at ? $workOrder->created_at->format('d M Y H:i') : '12 Sep 2025 08:43' }}
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span class="font-medium">Work Order ID:</span> #{{ $workOrder->id ?? '54' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Progress Overview -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8 shadow-md">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Progress Overview</h3>

                    @php
                        $totalSteps = 7; // Fixed number based on image
                        // Step sample status: 1 completed, 1 current, others pending
                        $completedSteps = 1; // WO Diterima completed
                        $progressPercentage = 14.3; // For the percentage text display
                        // Index of current step (0-based): 0=WO Diterima, 1=Mulai Timbang, ...
                        $currentIndex = 1; // Mulai Timbang
                        // For CSS calc below we will use currentIndex and totalSteps directly.
                    @endphp

                    <div class="mb-6">
                        <div class="flex items-center justify-between text-sm text-gray-600 mb-3">
                            <span class="font-medium">Overall Progress</span>
                            <span class="text-gray-500">{{ $completedSteps }} of {{ $totalSteps }} steps completed</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                            <div class="bg-green-500 h-3 rounded-full transition-all duration-700"
                                style="width: {{ $progressPercentage }}%"></div>
                        </div>
                        <div class="text-center mt-3">
                            <span class="text-2xl font-bold text-gray-900">{{ $progressPercentage }}%</span>
                        </div>
                    </div>
                </div>

                <!-- Tracking Steps -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8 shadow-md overflow-hidden">
                    <h3 class="text-xl font-semibold text-gray-900 mb-8 text-center">Tracking Steps</h3>

                    @php
                        $steps = [
                            ['key' => 'wo_received', 'label' => 'WO\nDiterima', 'state' => 'done'],
                            ['key' => 'start_scale', 'label' => 'Mulai\nTimbang', 'state' => 'current'],
                            ['key' => 'finish_scale', 'label' => 'Selesai\nTimbang', 'state' => 'pending'],
                            ['key' => 'cut_stock', 'label' => 'Potong\nStock', 'state' => 'pending'],
                            ['key' => 'released', 'label' => 'Released', 'state' => 'pending'],
                            ['key' => 'send_bb', 'label' => 'Kirim BB', 'state' => 'pending'],
                            ['key' => 'send_cpb', 'label' => 'Kirim\nCPB/WO', 'state' => 'pending'],
                        ];
                    @endphp

                    <div id="horizontal-tracking" class="horizontal-layout">
                        <div class="icons-row w-full">
                            <div class="track-line"></div>
                            <div class="track-line-progress"
                                style="width: calc((100% - 40px) * {{ $currentIndex }} / {{ max(1, $totalSteps - 1) }});"></div>

                            @foreach ($steps as $s)
                                <div class="step-item">
                                    <div class="relative z-10 mb-2">
                                        @php
                                            $classes = match ($s['state']) {
                                                'done' => 'is-done text-white',
                                                'current' => 'is-current text-white ring-4 ring-blue-200',
                                                default => 'is-pending text-gray-600',
                                            };
                                        @endphp
                                        <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg font-bold step-dot {{ $classes }}">
                                            @switch($s['key'])
                                                @case('wo_received')
                                                    <span class="text-xl font-bold">✓</span>
                                                    @break
                                                @case('start_scale')
                                                @case('finish_scale')
                                                    <!-- Scale icon (heroicons outline - scale) -->
                                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M6 6l3 8a4 4 0 11-8 0l3-8Zm12 0l3 8a4 4 0 11-8 0l3-8ZM12 6v12m-3 3h6" />
                                                    </svg>
                                                    @break
                                                @case('cut_stock')
                                                    <!-- Scissors icon -->
                                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.121 14.121L21 21M12 12l9-9M3.5 8.5a2.5 2.5 0 105 0 2.5 2.5 0 00-5 0zm0 7a2.5 2.5 0 105 0 2.5 2.5 0 00-5 0z" />
                                                    </svg>
                                                    @break
                                                @case('released')
                                                    <!-- Rocket (solid) -->
                                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                                        <!-- Nose and body -->
                                                        <path d="M12 2c3 0 6 2.239 6 6 0 3.7-2.393 8.068-6 11.5C8.393 16.068 6 11.7 6 8c0-3.761 3-6 6-6z"/>
                                                        <!-- Window -->
                                                        <circle cx="12" cy="8" r="2" fill="#fff"/>
                                                        <!-- Flame fin -->
                                                        <path d="M12 22l-2-3h4l-2 3z"/>
                                                    </svg>
                                                    @break
                                                @case('send_bb')
                                                    <!-- Cube/package (solid) -->
                                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                                        <path d="M21 7.5l-9-4.5-9 4.5 9 4.5 9-4.5z"/>
                                                        <path d="M3 8.67v6.66l8.25 4.12V12.79L3 8.67z"/>
                                                        <path d="M12.75 19.48L21 15.33V8.67l-8.25 4.12v6.69z"/>
                                                    </svg>
                                                    @break
                                                @case('send_cpb')
                                                    <!-- Clipboard/document (solid) -->
                                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                                        <path d="M9 2.25h6a1.5 1.5 0 011.5 1.5V6H7.5V3.75A1.5 1.5 0 019 2.25z"/>
                                                        <path d="M6 6h12a2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2z"/>
                                                        <path d="M8 10h8M8 13h8M8 16h6"/>
                                                    </svg>
                                                    @break
                                                @default
                                                    <span class="text-base">•</span>
                                            @endswitch
                                        </div>
                                    </div>
                                    <span class="step-label text-xs font-medium text-gray-700 whitespace-pre-line">{{ $s['label'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Step Details -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8 shadow-md">
                    <h4 class="text-lg font-semibold text-gray-900 mb-6">Step Details</h4>

                    <div class="space-y-4">
                        <!-- WO Diterima - Completed -->
                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center step-dot is-done text-white">
                                    <span class="text-base font-bold">✓</span>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">WO Diterima</p>
                                    <p class="text-sm text-green-600">Completed: 12 Sep 2025 08:43</p>
                                </div>
                            </div>
                            <span
                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                ✓ Complete
                            </span>
                        </div>

                        <!-- Mulai Timbang - Pending -->
                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center step-dot is-pending text-gray-600">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M6 6l3 8a4 4 0 11-8 0l3-8Zm12 0l3 8a4 4 0 11-8 0l3-8ZM12 6v12m-3 3h6" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Mulai Timbang</p>
                                    <p class="text-sm text-gray-500">Pending</p>
                                </div>
                            </div>
                            <span
                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                ⏳ Pending
                            </span>
                        </div>

                        <!-- Selesai Timbang - Pending -->
                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center step-dot is-pending text-gray-600">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M6 6l3 8a4 4 0 11-8 0l3-8Zm12 0l3 8a4 4 0 11-8 0l3-8ZM12 6v12m-3 3h6" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Selesai Timbang</p>
                                    <p class="text-sm text-gray-500">Pending</p>
                                </div>
                            </div>
                            <span
                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                ⏳ Pending
                            </span>
                        </div>

                        <!-- Potong Stock - Pending -->
                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center step-dot is-pending text-gray-600">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.121 14.121L21 21M12 12l9-9M3.5 8.5a2.5 2.5 0 105 0 2.5 2.5 0 00-5 0zm0 7a2.5 2.5 0 105 0 2.5 2.5 0 00-5 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Potong Stock</p>
                                    <p class="text-sm text-gray-500">Pending</p>
                                </div>
                            </div>
                            <span
                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                ⏳ Pending
                            </span>
                        </div>

                        <!-- Released - Pending -->
                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center step-dot is-pending text-gray-600">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2c3 0 6 2.239 6 6 0 3.7-2.393 8.068-6 11.5C8.393 16.068 6 11.7 6 8c0-3.761 3-6 6-6z"/>
                                        <circle cx="12" cy="8" r="1.6" fill="#ffffff"/>
                                        <path d="M12 22l-1.6-2.4h3.2L12 22z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Released</p>
                                    <p class="text-sm text-gray-500">Pending</p>
                                </div>
                            </div>
                            <span
                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                ⏳ Pending
                            </span>
                        </div>

                        <!-- Kirim BB - Pending -->
                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center step-dot is-pending text-gray-600">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M21 7.5l-9-4.5-9 4.5 9 4.5 9-4.5z"/>
                                        <path d="M3 8.67v6.66l8.25 4.12V12.79L3 8.67z"/>
                                        <path d="M12.75 19.48L21 15.33V8.67l-8.25 4.12v6.69z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Kirim BB</p>
                                    <p class="text-sm text-gray-500">Pending</p>
                                </div>
                            </div>
                            <span
                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                ⏳ Pending
                            </span>
                        </div>

                        <!-- Kirim CPB/WO - Pending -->
                        <div class="flex items-center justify-between py-3">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center step-dot is-pending text-gray-600">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M9 2.25h6a1.5 1.5 0 011.5 1.5V6H7.5V3.75A1.5 1.5 0 019 2.25z"/>
                                        <path d="M6 6h12a2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2z"/>
                                        <path d="M8 10h8M8 13h8M8 16h6"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Kirim CPB/WO</p>
                                    <p class="text-sm text-gray-500">Pending</p>
                                </div>
                            </div>
                            <span
                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                ⏳ Pending
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('public.work-orders') }}"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-blue-600 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                        Lihat Semua Work Orders
                    </a>
                    <a href="{{ route('public.home') }}"
                        class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Home
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
