<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MedMan - Smart Clinic Management</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-900 font-sans">
    <div class="min-h-screen flex flex-col selection:bg-indigo-500 selection:text-white">
        <!-- Navbar -->
        <nav class="bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <span class="font-bold text-xl tracking-tight text-gray-900">MedMan.</span>
                    </div>
                    <div>
                        @if (Route::has('login'))
                            <div class="flex gap-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-indigo-600 px-3 py-2 transition-colors">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-indigo-600 px-3 py-2 transition-colors">Log in</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="font-semibold text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-lg transition-colors shadow-sm">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero -->
        <main class="flex-grow flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 w-full">
                <div class="text-center max-w-3xl mx-auto">
                    <span class="inline-block py-1 px-3 rounded-full bg-indigo-50 text-indigo-600 text-sm font-semibold mb-4 border border-indigo-100">
                        ✨ Klinik Manajemen Masa Depan
                    </span>
                    <h1 class="text-5xl font-extrabold tracking-tight text-gray-900 sm:text-6xl mb-6">
                        Solusi Pintar untuk <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">Klinik Anda</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-10 leading-relaxed">
                        MedMan mempermudah dokter dan admin klinik dalam mencatat rekam medis, kelola pasien, antrean, hingga billing pembayaran secara terpusat dan tanpa kertas.
                    </p>
                    <div class="flex justify-center gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-indigo-600 text-white font-semibold px-8 py-3.5 rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                                Buka Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="bg-indigo-600 text-white font-semibold px-8 py-3.5 rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                                Mulai Sekarang Gratis
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="border-t border-gray-100 bg-white py-8">
            <div class="text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} MedMan System. Hak Cipta Dilindungi.
            </div>
        </footer>
    </div>
</body>
</html>
