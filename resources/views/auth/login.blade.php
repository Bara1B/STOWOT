@extends('layouts.auth')

@push('styles')
    @vite(['resources/css/auth-login.css'])
@endpush

@section('content')
    <div class="auth-container auth-bg-gradient">
        {{-- GLOBAL BACK BUTTON TOP-LEFT --}}
        <div class="absolute top-6 left-6 z-50">
            <a href="{{ route('public.home') }}" class="cracked-back-btn" aria-label="Kembali ke halaman publik">
                <div class="cracked-btn-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                <span class="back-label">Kembali</span>
                </div>
                <div class="crack-lines">
                    <div class="crack-line crack-1"></div>
                    <div class="crack-line crack-2"></div>
                    <div class="crack-line crack-3"></div>
                </div>
            </a>
        </div>

        {{-- LEFT PANEL - BRANDING --}}
        <div class="auth-left-panel">
            <div class="branding-content">
                <img src="{{ asset('images/logoPhapros.png') }}" alt="Phapros Logo" class="mx-auto h-20 w-auto mb-8">
                <h1 class="branding-title">Sistem SO & Tracking WO</h1>
                <p class="branding-subtitle">Tingkatkan efisiensi operasional dan kualitas layanan secara terpadu.</p>
                <div class="flex flex-wrap justify-center gap-3">
                    <span class="feature-chip">Real-time Tracking</span>
                    <span class="feature-chip">Integrasi Mulus</span>
                    <span class="feature-chip">Analitik Cerdas</span>
                </div>
            </div>
        </div>

        {{-- RIGHT PANEL - LOGIN FORM --}}
        <div class="auth-right-panel">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div class="login-card p-8">
                    <div class="text-center mb-8">
                        <img src="{{ asset('images/logoPhapros.png') }}" alt="Phapros" class="mx-auto h-12 w-auto mb-4">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Masuk ke Akun Anda</h2>
                        <p class="text-gray-600">Silakan login untuk melanjutkan proses</p>
                        </div>

                    <form method="POST" action="{{ route('login') }}" class="space-y-6" aria-describedby="login-help">
                            @csrf
                            @if ($errors->any())
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                                <div class="flex">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-800">Terjadi kesalahan</h3>
                                        <p class="text-sm text-red-700 mt-1">Periksa kembali input Anda.</p>
                                    </div>
                                </div>
                                </div>
                            @endif

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
                                <div class="input-with-icon">
                                    <span class="form-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="5" width="18" height="14" rx="2" />
                                        <path d="M3 7l9 6 9-6" />
                                    </svg>
                                    </span>
                                <input id="email" type="email"
                                    class="form-control @error('email') border-red-300 @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus
                                    aria-invalid="@error('email') true @else false @enderror"
                                    aria-describedby="emailHelp @error('email') emailError @enderror"
                                    placeholder="Masukkan email Anda">
                                </div>
                                @error('email')
                                <p id="emailError" class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>
                                @enderror
                            </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                                <div class="input-with-icon">
                                    <span class="form-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="4" y="11" width="16" height="9" rx="2" />
                                        <path d="M12 11c0-1.1.9-2 2-2s2 .9 2 2" />
                                        <path d="M4 11V7a4 4 0 0 1 8 0v4" />
                                    </svg>
                                    </span>
                                <input id="password" type="password"
                                    class="form-control @error('password') border-red-300 @enderror" name="password"
                                    required autocomplete="current-password"
                                    aria-invalid="@error('password') true @else false @enderror"
                                    aria-describedby="passwordHelp @error('password') passwordError @enderror"
                                    placeholder="Masukkan password Anda">
                                <button type="button" class="password-toggle" aria-label="Tampilkan password"
                                    onclick="(function(btn){const i=document.getElementById('password'); if(!i) return; const isP=i.type==='password'; i.type=isP?'text':'password'; btn.setAttribute('aria-label', isP?'Sembunyikan password':'Tampilkan password');})(this)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                    </button>
                                </div>
                                @error('password')
                                <p id="passwordError" class="mt-2 text-sm text-red-600" role="alert">{{ $message }}
                                </p>
                                @enderror
                            </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember" name="remember" type="checkbox"
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                        {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember" class="ml-2 block text-sm text-gray-700">Ingat Saya</label>
                                </div>
                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-sm text-blue-600 hover:text-blue-500 font-medium">Lupa Password?</a>
                                @endif
                            </div>

                        <div>
                            <button type="submit"
                                class="btn-login-gradient w-full flex justify-center items-center gap-2">
                                    Login
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </button>
                            </div>

                        <div class="text-center" id="login-help">
                            <p class="text-sm text-gray-600">Butuh akses? Hubungi administrator.</p>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
