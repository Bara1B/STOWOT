@extends('layouts.public')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Header Section -->
        <div class="bg-white py-8 border-b border-gray-200">
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
                <div class="bg-white rounded-lg border border-gray-200 p-6 mb-8">
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
                <div class="bg-white rounded-lg border border-gray-200 p-6 mb-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Progress Overview</h3>

                    @php
                        $totalSteps = 7; // Fixed number based on image
                        $completedSteps = 1; // WO Diterima completed
                        $progressPercentage = 14.3; // As shown in image
                    @endphp

                    <div class="mb-6">
                        <div class="flex items-center justify-between text-sm text-gray-600 mb-3">
                            <span class="font-medium">Overall Progress</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-blue-500 h-3 rounded-full transition-all duration-500"
                                style="width: {{ $progressPercentage }}%"></div>
                        </div>
                        <div class="text-center mt-3">
                            <span class="text-2xl font-bold text-gray-900">{{ $progressPercentage }}%</span>
                        </div>
                    </div>
                </div>

                <!-- Tracking Steps -->
                <div class="bg-white rounded-lg border border-gray-200 p-6 mb-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-8 text-center">Tracking Steps</h3>

                    <!-- Horizontal Progress Icons -->
                    <div class="flex items-center justify-center space-x-8 mb-8">
                        <!-- WO Diterima - Completed -->
                        <div class="flex flex-col items-center">
                            <div
                                class="w-12 h-12 rounded-full bg-green-500 text-white flex items-center justify-center text-lg font-bold mb-2">
                                ✓
                            </div>
                            <span class="text-xs text-center font-medium text-gray-700">WO<br>Diterima</span>
                        </div>

                        <!-- Mulai Timbang - Current -->
                        <div class="flex flex-col items-center">
                            <div
                                class="w-12 h-12 rounded-full bg-blue-500 text-white flex items-center justify-center text-lg font-bold mb-2">
                                ⚖
                            </div>
                            <span class="text-xs text-center font-medium text-gray-700">Mulai<br>Timbang</span>
                        </div>

                        <!-- Selesai Timbang - Pending -->
                        <div class="flex flex-col items-center">
                            <div
                                class="w-12 h-12 rounded-full bg-gray-300 text-gray-500 flex items-center justify-center text-lg font-bold mb-2">
                                ⚖
                            </div>
                            <span class="text-xs text-center font-medium text-gray-700">Selesai<br>Timbang</span>
                        </div>

                        <!-- Potong Stock - Pending -->
                        <div class="flex flex-col items-center">
                            <div
                                class="w-12 h-12 rounded-full bg-gray-300 text-gray-500 flex items-center justify-center text-lg font-bold mb-2">
                                ✂
                            </div>
                            <span class="text-xs text-center font-medium text-gray-700">Potong<br>Stock</span>
                        </div>

                        <!-- Released - Pending -->
                        <div class="flex flex-col items-center">
                            <div
                                class="w-12 h-12 rounded-full bg-gray-300 text-gray-500 flex items-center justify-center text-lg font-bold mb-2">
                                🚀
                            </div>
                            <span class="text-xs text-center font-medium text-gray-700">Released</span>
                        </div>

                        <!-- Kirim BB - Pending -->
                        <div class="flex flex-col items-center">
                            <div
                                class="w-12 h-12 rounded-full bg-gray-300 text-gray-500 flex items-center justify-center text-lg font-bold mb-2">
                                📦
                            </div>
                            <span class="text-xs text-center font-medium text-gray-700">Kirim BB</span>
                        </div>

                        <!-- Kirim CPB/WO - Pending -->
                        <div class="flex flex-col items-center">
                            <div
                                class="w-12 h-12 rounded-full bg-gray-300 text-gray-500 flex items-center justify-center text-lg font-bold mb-2">
                                📋
                            </div>
                            <span class="text-xs text-center font-medium text-gray-700">Kirim<br>CPB/WO</span>
                        </div>
                    </div>
                </div>

                <!-- Step Details -->
                <div class="bg-white rounded-lg border border-gray-200 p-6 mb-8">
                    <h4 class="text-lg font-semibold text-gray-900 mb-6">Step Details</h4>

                    <div class="space-y-4">
                        <!-- WO Diterima - Completed -->
                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
                                    ✓
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
                                <div
                                    class="w-8 h-8 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center">
                                    ⚖
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
                                <div
                                    class="w-8 h-8 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center">
                                    ⚖
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
                                <div
                                    class="w-8 h-8 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center">
                                    ✂
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
                                <div
                                    class="w-8 h-8 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center">
                                    🚀
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
                                <div
                                    class="w-8 h-8 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center">
                                    📦
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
                                <div
                                    class="w-8 h-8 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center">
                                    📋
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
