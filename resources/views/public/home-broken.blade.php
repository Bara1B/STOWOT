@extends('layouts.public')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Header Section -->
        <div class="bg-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <!-- Logo Phapros -->
                <div class="mb-8">
                    <img src="{{ asset('images/logoPhapros.png') }}" alt="Phapros Logo" class="h-20 mx-auto">
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
                    <a href="{{ route('public.work-orders') }}"
                        class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Lihat Work Orders
                    </a>
                    <a href="{{ route('public.tracking') }}"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Mulai Tracking
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="py-16 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Statistik Work Order</h2>
                    <p class="text-lg text-gray-600">Overview progress dan status terkini</p>
                </div>

                <!-- Charts Section -->
                <div class="mb-12">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="inline-flex w-9 h-9 rounded-xl bg-blue-600/10 text-blue-700 items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
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
                            <h4 class="text-lg font-medium text-gray-700 mb-4">Total Work Order per Bulan ({{ date('Y') }})</h4>
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
                                <p class="text-blue-100 text-sm">Total Work Orders</p>
                                <p class="text-3xl font-bold">{{ number_format($totalWorkOrders ?? 0) }}</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-400 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Pending -->
                    <div class="bg-yellow-500 rounded-2xl p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-yellow-100 text-sm">Pending</p>
                                <p class="text-3xl font-bold">{{ number_format($pendingWorkOrders ?? 0) }}</p>
                            </div>
                            <div class="w-12 h-12 bg-yellow-400 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Completed -->
                    <div class="bg-green-500 rounded-2xl p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-green-100 text-sm">Completed</p>
                                <p class="text-3xl font-bold">{{ number_format($completedWorkOrders ?? 0) }}</p>
                            </div>
                            <div class="w-12 h-12 bg-green-400 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Overdue -->
                    <div class="bg-red-500 rounded-2xl p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-red-100 text-sm">Overdue</p>
                                <p class="text-3xl font-bold">{{ number_format($overdueWorkOrders ?? 0) }}</p>
                            </div>
                            <div class="w-12 h-12 bg-red-400 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
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

                <div class="space-y-4">
                    @forelse($recentWorkOrders ?? [] as $workOrder)
                        <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center text-white font-medium">
                                    {{ substr($workOrder->wo_number ?? 'WO', 0, 2) }}
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">{{ $workOrder->wo_number ?? 'N/A' }}</h3>
                                    <p class="text-sm text-gray-500">{{ $workOrder->output ?? 'No description' }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    @if(($workOrder->status ?? '') === 'Completed') bg-green-100 text-green-800 
                                    @elseif(($workOrder->status ?? '') === 'On Progress') bg-yellow-100 text-yellow-800 
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $workOrder->status ?? 'Unknown' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <p class="text-gray-500">Belum ada work order terbaru</p>
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
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Real-time Tracking</h3>
                        <p class="text-gray-300">Monitor progress work order secara real-time dengan update status yang akurat</p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Efisien & Produktif</h3>
                        <p class="text-gray-300">Optimalkan workflow produksi dengan sistem yang mudah digunakan</p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
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
                        labels: ['Pending', 'Completed', 'Overdue'],
                        datasets: [{
                            data: [
                                {{ $pendingWorkOrders ?? 0 }},
                                {{ $completedWorkOrders ?? 0 }},
                                {{ $overdueWorkOrders ?? 0 }}
                            ],
                            backgroundColor: [
                                '#EAB308', // yellow-500
                                '#22C55E', // green-500
                                '#EF4444'  // red-500
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
                            }
                        }
                    }
                });
            }

            // Monthly Line Chart
            const monthlyCtx = document.getElementById('woMonthlyChart');
            if (monthlyCtx) {
                const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                const monthlyData = @json($monthlyWoData ?? [0,0,0,0,0,0,0,0,0,0,0,0]);
                
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
