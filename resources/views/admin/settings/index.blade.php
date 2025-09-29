@extends('layouts.app')

@section('title', 'Pengaturan Admin')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-900">Pengaturan Admin</h1>
                <p class="text-gray-500">Kelola sistem dan konfigurasi aplikasi</p>
            </div>

            <div class="bg-white rounded-lg shadow border border-gray-100">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-medium text-gray-900">Dashboard Pengaturan</h2>
                    <a href="{{ route('admin.home') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>

                <div class="p-6 space-y-8">
                    <!-- Stats -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="col-span-1 sm:col-span-3 bg-blue-50 border border-blue-100 rounded-lg p-5 flex items-center">
                            <div class="flex items-center justify-center h-10 w-10 rounded-full bg-blue-100 text-blue-600 mr-4">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-blue-700">{{ $stats['total_users'] ?? 0 }}</div>
                                <div class="text-sm uppercase tracking-wide text-blue-700/80">Total Users</div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick links -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('settings.edit') }}" class="group block rounded-lg border border-gray-200 hover:border-blue-300 hover:shadow-md transition bg-white p-5">
                            <div class="flex items-start">
                                <div class="h-10 w-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mr-3">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                <div>
                                    <div class="text-base font-medium text-gray-900">Settings Sistem</div>
                                    <div class="text-sm text-gray-500">Konfigurasi pengaturan untuk Work Order dan Stock Opname</div>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('admin.settings.users') }}" class="group block rounded-lg border border-gray-200 hover:border-blue-300 hover:shadow-md transition bg-white p-5">
                            <div class="flex items-start">
                                <div class="h-10 w-10 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center mr-3">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div>
                                    <div class="text-base font-medium text-gray-900">User Management</div>
                                    <div class="text-sm text-gray-500">Kelola akun pengguna, role, dan permissions</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Recent users -->
                    <div>
                        <div class="flex items-center mb-3">
                            <div class="h-9 w-9 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center mr-2">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h3 class="text-base font-medium text-gray-900">Recent Users</h3>
                        </div>
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($users as $user)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="h-8 w-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mr-2">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->email }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                                        {{ ucfirst($user->role) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-6 py-6 text-center text-gray-500">
                                                    <i class="fas fa-info-circle mr-2"></i>No users found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @if ($users->hasPages())
                                <div class="px-6 py-3 border-t border-gray-200">
                                    {{ $users->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
