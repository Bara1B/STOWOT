@extends('layouts.public')

@section('content')
    <div class="min-h-screen">
        <!-- Hero Section with Gradient Background -->
        <div class="relative bg-gradient-to-br from-orange-500 to-blue-600 py-24 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto text-center text-white">
                <!-- Logo Phapros -->
                <div class="mb-8">
                    <img src="{{ asset('images/logoPhapros.png') }}" alt="Phapros Logo"
                        class="h-24 mx-auto filter brightness-0 invert">
                </div>

                <!-- Main Title -->
                <h1 class="text-5xl md:text-6xl font-bold mb-6">Work Order Tracker</h1>
                <p class="text-xl md:text-2xl mb-12 max-w-3xl mx-auto opacity-90">
                    Sistem tracking work order yang efisien dan real-time untuk monitoring progress produksi
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('public.work-orders') }}"
                        class="inline-flex items-center px-8 py-4 border-2 border-white text-lg font-medium rounded-xl text-white bg-transparent hover:bg-white hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white transition-all duration-300 shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                        Lihat Work Orders
                    </a>
                    <a href="{{ route('public.work-orders') }}"
                        class="inline-flex items-center px-8 py-4 border-2 border-transparent text-lg font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-300 shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Mulai Tracking
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="py-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-transparent to-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Statistik Work Order</h2>
                    <p class="text-lg text-gray-600">Overview progress dan status terkini</p>
                </div>

                <!-- Charts Section -->
                <div class="mb-12">
                    <div class="flex items-center gap-2 mb-6">
                        <span
                            class="inline-flex w-9 h-9 rounded-xl bg-blue-600/10 text-blue-700 items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </span>
                        <h3 class="text-xl font-semibold text-gray-900">Visualisasi Statistik</h3>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Donut Chart -->
                        <div class="bg-white rounded-2xl p-6 shadow-lg">
                            <h4 class="text-lg font-medium text-gray-700 mb-4">Status Work Order</h4>
                            <div class="relative h-80 flex items-center justify-center">
                                <canvas id="woDonutChart"></canvas>
                            </div>
                        </div>

                        <!-- Line Chart -->
                        <div class="bg-white rounded-2xl p-6 shadow-lg">
                            <h4 class="text-lg font-medium text-gray-700 mb-4">Total Work Order per Bulan
                                ({{ date('Y') }})</h4>
                            <div class="relative h-80">
                                <canvas id="woMonthlyChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                    <!-- Total Work Orders -->
                    <div class="bg-blue-500 rounded-2xl p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-blue-100 text-sm font-medium">Total Work Orders</p>
                                <p class="text-3xl font-bold">{{ number_format($totalWorkOrders ?? 0) }}</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-400 rounded-xl flex items-center justify-center">
                                <span class="text-2xl font-bold">📋</span>
                            </div>
                        </div>
                    </div>

                    <!-- Pending -->
                    <div class="bg-yellow-500 rounded-2xl p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-yellow-100 text-sm font-medium">Pending</p>
                                <p class="text-3xl font-bold">{{ number_format($pendingWorkOrders ?? 0) }}</p>
                            </div>
                            <div class="w-12 h-12 bg-yellow-400 rounded-xl flex items-center justify-center">
                                <span class="text-2xl font-bold">⏳</span>
                            </div>
                        </div>
                    </div>

                    <!-- Completed -->
                    <div class="bg-green-500 rounded-2xl p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-green-100 text-sm font-medium">Completed</p>
                                <p class="text-3xl font-bold">{{ number_format($completedWorkOrders ?? 0) }}</p>
                            </div>
                            <div class="w-12 h-12 bg-green-400 rounded-xl flex items-center justify-center">
                                <span class="text-2xl font-bold">✅</span>
                            </div>
                        </div>
                    </div>

                    <!-- Overdue -->
                    <div class="bg-red-500 rounded-2xl p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-red-100 text-sm font-medium">Overdue</p>
                                <p class="text-3xl font-bold">{{ number_format($overdueWorkOrders ?? 0) }}</p>
                            </div>
                            <div class="w-12 h-12 bg-red-400 rounded-xl flex items-center justify-center">
                                <span class="text-2xl font-bold">🚨</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Work Orders Section -->
        <div class="py-16 px-4 sm:px-6 lg:px-8 bg-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Work Order Terbaru</h2>
                    <p class="text-lg text-gray-600">Monitor progress work order terkini</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($recentWorkOrders ?? [] as $workOrder)
                        <div
                            class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900 mb-1">{{ $workOrder->wo_number ?? 'N/A' }}</h3>
                                    <p class="text-sm text-gray-600 mb-2">{{ $workOrder->output ?? 'No description' }}</p>
                                    <p class="text-xs text-gray-500">Due:
                                        {{ $workOrder->due_date ? \Carbon\Carbon::parse($workOrder->due_date)->format('d M Y') : 'No due date' }}
                                    </p>
                                </div>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    @if (($workOrder->status ?? '') === 'Completed') bg-green-100 text-green-800 
                                    @elseif(($workOrder->status ?? '') === 'On Progress') bg-yellow-100 text-yellow-800 
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $workOrder->status ?? 'Unknown' }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span
                                    class="text-xs text-gray-500">{{ $workOrder->created_at ? $workOrder->created_at->diffForHumans() : '' }}</span>
                                <a href="{{ route('public.work-orders') }}"
                                    class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Lihat Detail →
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <div class="text-gray-400 text-6xl mb-4">📋</div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada work order</h3>
                            <p class="text-gray-500">Work order terbaru akan muncul di sini</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="py-16 px-4 sm:px-6 lg:px-8 bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold mb-4">Fitur Unggulan</h2>
                    <p class="text-lg text-gray-300">Mengapa memilih Work Order Tracker kami?</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl">📊</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Real-time Tracking</h3>
                        <p class="text-gray-300">Monitor progress work order secara real-time dengan update status yang
                            akurat</p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl">⚡</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Efisien & Produktif</h3>
                        <p class="text-gray-300">Optimalkan workflow produksi dengan sistem yang mudah digunakan</p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl">🔒</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Keamanan Data</h3>
                        <p class="text-gray-300">Data work order tersimpan aman dengan sistem backup dan enkripsi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Donut Chart
            const donutCtx = document.getElementById('woDonutChart');
            if (donutCtx) {
                new Chart(donutCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Total', 'Pending', 'Completed', 'Overdue'],
                        datasets: [{
                            data: [
                                {{ $totalWorkOrders ?? 0 }},
                                {{ $pendingWorkOrders ?? 0 }},
                                {{ $completedWorkOrders ?? 0 }},
                                {{ $overdueWorkOrders ?? 0 }}
                            ],
                            backgroundColor: [
                                '#3B82F6',
                                '#EAB308',
                                '#22C55E',
                                '#EF4444'
                            ],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '70%',
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const value = context.parsed;
                                        if (context.label === 'Total') {
                                            return context.label + ': ' + value + ' Work Orders';
                                        } else {
                                            const total = {{ $totalWorkOrders ?? 0 }};
                                            const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                            return context.label + ': ' + value + ' (' + percentage + '%)';
                                        }
                                    }
                                }
                            }
                        },
                        onHover: (event, activeElements) => {
                            event.native.target.style.cursor = activeElements.length > 0 ? 'pointer' : 'default';
                        }
                    }
                });
            }

            // Monthly Line Chart
            const monthlyCtx = document.getElementById('woMonthlyChart');
            if (monthlyCtx) {
                const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                    'Dec'
                ];
                const monthlyData = {!! json_encode($monthlyWoData ?? [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]) !!};

                new Chart(monthlyCtx, {
                    type: 'line',
                    data: {
                        labels: monthNames,
                        datasets: [{
                            label: 'Work Orders',
                            data: monthlyData,
                            borderColor: '#3B82F6',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            }
        });
    </script>
@endsection
