<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="logout-url" content="{{ route('logout') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Inter Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body>
    <div id="app">
        <!-- Global Loading Overlay -->
        <div id="global-loading"
            class="hidden fixed inset-0 z-50 bg-gray-900/50 backdrop-blur-sm items-center justify-center">
            <div class="flex flex-col items-center gap-3 p-6 bg-white rounded-lg shadow-lg">
                <svg class="animate-spin h-8 w-8 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
                <p class="text-sm text-gray-700 font-medium">Memproses... Mohon tunggu</p>
            </div>
        </div>

        <!-- Notification Component -->
        <x-notification />

        <!-- Enhanced Verification Manager -->
        <x-verification-manager :work-order-id="request()->route('workOrder')" />

        @if (Auth::user() && Auth::user()->role === 'admin')
            <!-- Top Navbar -->
            <nav class="top-navbar">
                <div class="navbar-content">
                    <div class="navbar-left">
                        <button class="sidebar-toggle-btn" onclick="toggleSidebar()">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="navbar-brand">
                            <img src="{{ asset('images/LogoPhapros.png') }}" alt="Phapros"
                                style="width: 60px; height: 60px; object-fit: contain;"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
                            <i class="fas fa-pills" style="display: none; color: #3b82f6;"></i>
                            <img src="{{ asset('images/kimiaFarma.png') }}" alt="Kimia Farma"
                                style="width: 60px; height: 60px; object-fit: contain; margin-left: 10px;"
                                onerror="this.style.display='none';">
                        </div>
                    </div>
                    <div class="navbar-right">
                    </div>
                </div>
            </nav>

            <!-- Sidebar -->
            <div class="unified-sidebar" id="sidebar">

                <div class="sidebar-content">
                    <!-- Main Section -->
                    <div class="sidebar-section">
                        <div class="section-title">Main</div>
                        <div class="menu-items">
                            <a href="{{ route('admin.home') }}"
                                class="menu-item {{ request()->routeIs('admin.home') ? 'active' : '' }}">
                                <i class="fas fa-home"></i>
                                <span class="menu-text">Dashboard</span>
                            </a>
                            <a href="{{ route('dashboard') }}"
                                class="menu-item {{ request()->routeIs('dashboard*') ? 'active' : '' }}">
                                <i class="fas fa-clipboard-list"></i>
                                <span class="menu-text">Work Orders</span>
                            </a>
                            <a href="{{ route('admin.stock-opname.index') }}"
                                class="menu-item {{ request()->routeIs('admin.stock-opname.*') ? 'active' : '' }}">
                                <i class="fas fa-clipboard-check"></i>
                                <span class="menu-text">Stock Opname</span>
                            </a>
                        </div>
                    </div>

                    <!-- Data Section -->
                    <div class="sidebar-section">
                        <div class="section-title">Data</div>
                        <div class="menu-items">
                            <a href="{{ route('admin.data-master') }}"
                                class="menu-item {{ request()->routeIs('admin.data-master') || request()->routeIs('overmate.*') ? 'active' : '' }}">
                                <i class="fas fa-database"></i>
                                <span class="menu-text">Data Master</span>
                            </a>
                        </div>
                    </div>

                    <!-- System Section -->
                    <div class="sidebar-section">
                        <div class="section-title">System</div>
                        <div class="menu-items">
                            <a href="{{ route('admin.settings.index') }}"
                                class="menu-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                                <i class="fas fa-cog"></i>
                                <span class="menu-text">Settings</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- User Section -->
                <div class="sidebar-footer">
                    <div class="user-info">
                        <div class="user-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="user-details">
                            <div class="user-name">{{ Auth::user()->name }}</div>
                            <div class="user-role">Administrator</div>
                        </div>
                    </div>
                    <a href="{{ route('logout') }}" class="logout-btn" onclick="confirmLogout(event);">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="menu-text">Logout</span>
                    </a>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="main-content" id="main-content">
                @yield('content')
            </div>
        @else
            <!-- Modern User Layout -->
            <div class="min-h-screen bg-gray-50">
                <!-- Top Navigation Bar -->
                <nav class="navbar">
                    <div class="container">
                        <div class="flex items-center justify-between h-16">
                            <!-- Left side - Logo & Brand -->
                            <div class="flex items-center">
                                <div class="sidebar-logo mr-3">P</div>
                                <span class="navbar-brand">Pharmaceutical Tracker</span>
                            </div>

                            <!-- Center - Navigation Links -->
                            <div class="navbar-nav hidden md:flex">
                                <a href="{{ route('home') }}"
                                    class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                                    <i class="fas fa-home mr-2"></i>Home
                                </a>
                                <a href="{{ route('dashboard') }}"
                                    class="nav-link {{ request()->routeIs('dashboard*') ? 'active' : '' }}">
                                    <i class="fas fa-clipboard-list mr-2"></i>Work Orders
                                </a>
                                <a href="{{ route('stock-opname.index') }}"
                                    class="nav-link {{ request()->routeIs('stock-opname.*') ? 'active' : '' }}">
                                    <i class="fas fa-boxes mr-2"></i>Stock Opname
                                </a>
                            </div>

                            <!-- Right side - User Menu -->
                            <div class="flex items-center gap-4">
                                <div class="user-menu">
                                    <button class="user-menu-trigger" onclick="toggleUserMenu()">
                                        <div class="user-avatar">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        </div>
                                        <div class="user-info">
                                            <div class="user-name">{{ Auth::user()->name }}</div>
                                        </div>
                                    </button>

                                    <div class="dropdown-menu" id="userMenu">
                                        <a href="#" class="dropdown-item">
                                            <i class="fas fa-user"></i>
                                            Profile
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a href="{{ route('logout') }}" class="dropdown-item"
                                            onclick="confirmLogout(event);">
                                            <i class="fas fa-sign-out-alt"></i>
                                            Logout
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Main Content -->
                <main class="container py-8">
                    @yield('content')
                </main>
            </div>
        @endif
    </div>

    <!-- Logout Confirmation Modal -->
    <div id="logout-confirm-overlay" class="fixed inset-0 bg-black/40 z-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-sm p-5">
            <div class="flex items-center gap-3 mb-3">
                <i class="fas fa-sign-out-alt text-red-500 text-xl"></i>
                <h3 class="text-lg font-semibold text-gray-900">Konfirmasi Logout</h3>
            </div>
            <p class="text-sm text-gray-600 mb-5">Anda yakin ingin keluar?</p>
            <div class="flex justify-end gap-2">
                <button type="button" class="px-4 py-2 rounded-md border text-gray-700 hover:bg-gray-50"
                    onclick="hideLogoutConfirm()">
                    <i class="fas fa-times mr-1"></i> Tidak
                </button>
                <button type="button" class="px-4 py-2 rounded-md bg-red-600 text-white hover:bg-red-700"
                    onclick="proceedLogout()">
                    <i class="fas fa-check mr-1"></i> Ya
                </button>
            </div>
        </div>
    </div>

    <script>
        // Sidebar functionality for unified sidebar
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            var mainContent = document.querySelector('.main-content');
            if (!sidebar) {
                return;
            }

            sidebar.classList.toggle('mini');

            // Save state
            localStorage.setItem('sidebarMini', sidebar.classList.contains('mini'));
        }


        // Load saved state
        document.addEventListener('DOMContentLoaded', function() {
            var sidebar = document.getElementById('sidebar');
            var isMini = localStorage.getItem('sidebarMini') === 'true';
            if (!sidebar) {
                return;
            }
            if (isMini) {
                sidebar.classList.add('mini');
            }
        });

        function confirmLogout(e) {
            e.preventDefault();
            // Create a temporary form for logout
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('logout') }}';

            var csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';

            form.appendChild(csrfToken);

            var overlay = document.getElementById('logout-confirm-overlay');
            if (overlay) {
                pendingLogoutForm = form;
                overlay.classList.remove('hidden');
                overlay.classList.add('flex');
            } else {
                // Fallback to native confirm
                if (confirm('Anda yakin ingin keluar?')) {
                    document.body.appendChild(form);
                    form.submit();
                }
            }
        }

        function hideLogoutConfirm() {
            var overlay = document.getElementById('logout-confirm-overlay');
            if (!overlay) return;
            overlay.classList.add('hidden');
            overlay.classList.remove('flex');
        }

        function proceedLogout() {
            hideLogoutConfirm();
            if (pendingLogoutForm) {
                document.body.appendChild(pendingLogoutForm);
                pendingLogoutForm.submit();
            }
        }

        // Mobile responsive handling
        window.addEventListener('resize', function() {
            if (window.innerWidth <= 768) {
                document.documentElement.classList.add('sidebar-collapsed');
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
