<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Klinik MedMan') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F4F6FC] font-['Poppins'] text-gray-800 antialiased h-screen overflow-hidden flex">

    <!-- Left Column (Logo & Floating Sidebar) -->
    <div class="w-[120px] flex flex-col items-center py-6 h-full flex-shrink-0 z-20">

        <!-- Logo -->
        <div class="w-[60px] h-[60px] bg-white rounded-full flex items-center justify-center shadow-md overflow-hidden p-1 border-[3px] border-[#0A3D74] mb-6">
            <image src="{{ asset('images/logoApotek.svg') }}" alt="Logo" class="w-full h-full object-cover">
        </div>

        <!-- Blue Sidebar Pill -->
        <nav class="w-24 flex-1 bg-[#6A9DF6] rounded-t-[20px] flex flex-col items-center py-6 text-white shadow-lg overflow-y-auto mb-2 space-y-7 relative">

            <!-- Dashboard (Active) -->
            <a href="{{ route('dashboard') }}" class="group relative flex flex-col items-center justify-center w-full cursor-pointer transition-colors pt-2">
                <span class="text-[10px] font-semibold mb-1">Dashboard</span>
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M11.47 3.84a.75.75 0 011.06 0l8.99 9A.75.75 0 1120.46 14l-1.25-1.25V20a2 2 0 01-2 2h-3v-5a1 1 0 00-1-1h-2a1 1 0 00-1 1v5H7a2 2 0 01-2-2v-7.25L3.75 14a.75.75 0 01-1.06-1.06l8.78-9z"></path>
                </svg>
                <!-- Active Indicator Arrow -->
                @if(request()->routeIs('dashboard'))
                <svg class="absolute right-[-5px] top-[65%] -translate-y-1/2 w-6 h-8 text-[#8ED1FC] drop-shadow-md" viewBox="0 0 26 36" fill="currentColor" stroke="white" stroke-width="4" stroke-linejoin="round">
                    <path d="M24 4 L4 18 L24 32 Z" />
                </svg>
                @endif
            </a>

            <!-- Pasien -->
            <a href="{{ route('patients.index') }}" class="group relative flex flex-col items-center justify-center w-full cursor-pointer transition-colors opacity-90 hover:opacity-100">
                <span class="text-[10px] font-semibold mb-1">Pasien</span>
                <div class="relative">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                    </svg>
                    <svg class="w-4 h-4 absolute -bottom-1 -right-1 text-white bg-[#6A9DF6] rounded-full" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                @if(request()->routeIs('patients.*'))
                <svg class="absolute right-[-10px] top-[60%] -translate-y-1/2 w-6 h-8 text-[#8ED1FC] drop-shadow-md" viewBox="0 0 26 36" fill="currentColor" stroke="white" stroke-width="4" stroke-linejoin="round">
                    <path d="M24 4 L4 18 L24 32 Z" />
                </svg>
                @endif
            </a>

            <!-- Kunjungan -->
            <a href="{{ route('queue.index') }}" class="group relative flex flex-col items-center justify-center w-full cursor-pointer transition-colors opacity-90 hover:opacity-100">
                <span class="text-[10px] font-semibold mb-1">Kunjungan</span>
                <div class="relative">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-2h2v2zm0-4H7v-2h2v2zm0-4H7V7h2v2zm4 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V7h2v2zm4 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V7h2v2z" />
                    </svg>
                    <svg class="w-4 h-4 absolute -bottom-1 -right-1 text-white bg-[#6A9DF6] rounded-full" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                @if(request()->routeIs('queue.*'))
                <svg class="absolute right-[-10px] top-[60%] -translate-y-1/2 w-6 h-8 text-[#8ED1FC] drop-shadow-md" viewBox="0 0 26 36" fill="currentColor" stroke="white" stroke-width="4" stroke-linejoin="round">
                    <path d="M24 4 L4 18 L24 32 Z" />
                </svg>
                @endif
            </a>

            <!-- Stok -->
            <a href="{{ route('stock.index') }}" class="group relative flex flex-col items-center justify-center w-full cursor-pointer transition-colors opacity-90 hover:opacity-100">
                <span class="text-[10px] font-semibold mb-1">Stok</span>
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M3 5v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.11 0-2 .9-2 2zm12 4c0 1.66-1.34 3-3 3s-3-1.34-3-3V5h6v4z" />
                </svg>
                @if(request()->routeIs('stock.*'))
                <svg class="absolute right-[-10px] top-[60%] -translate-y-1/2 w-6 h-8 text-[#8ED1FC] drop-shadow-md" viewBox="0 0 26 36" fill="currentColor" stroke="white" stroke-width="4" stroke-linejoin="round">
                    <path d="M24 4 L4 18 L24 32 Z" />
                </svg>
                @endif
            </a>
        </nav>
    </div>

    <!-- Right Side (Header Texts + Main Content Area) -->
    <div class="flex-1 flex flex-col h-full overflow-hidden">

        <!-- Headers -->
        <header class="h-24 flex items-center justify-between pr-8 border-transparent flex-shrink-0 pt-4 relative z-50">
            <div class="flex flex-col justify-center">
                <h1 class="text-[22px] font-extrabold tracking-tight text-gray-900 leading-tight uppercase">PRAKTER DOKTER MANDIRI "APOTEK BUBULAK"</h1>
                <p class="text-[13px] text-gray-600 font-medium">Jl. Bubulak, Bogor Jawa Barat</p>
            </div>

            <!-- Profile Dropdown Widget (Keren!) -->
            <div class="relative group cursor-pointer z-50">
                <div class="flex items-center gap-3 bg-white px-4 py-2.5 rounded-full shadow-[0_2px_10px_rgba(0,0,0,0.02)] border border-gray-100 hover:shadow-[0_4px_15px_rgba(0,0,0,0.05)] transition-all">
                    <div class="flex flex-col text-right">
                        <span class="text-[9px] text-gray-400 font-bold uppercase tracking-wider mb-0.5">Selamat Datang</span>
                        <span class="text-[13px] font-extrabold text-[#0A3D74]">{{ Auth::user()->name ?? 'dr. Andini Hurul Aini' }}</span>
                    </div>
                    <div class="relative">
                        <img class="w-9 h-9 rounded-full object-cover border-2 border-[#6A9DF6] p-[1.5px]" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=EBF4FF&color=0A3D74&bold=true" alt="Avatar">
                        <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 border-2 border-white rounded-full"></span>
                    </div>
                </div>

                <!-- Dropdown Menu -->
                <div class="absolute top-full right-0 mt-2 w-52 bg-white rounded-2xl shadow-[0_10px_30px_rgba(0,0,0,0.08)] border border-gray-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right group-hover:translate-y-0 translate-y-2 overflow-hidden">
                    <div class="p-4 border-b border-gray-50 bg-[#F8FAFC]">
                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1.5">Status Akun</p>
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-green-500 shadow-[0_0_5px_rgba(34,197,94,0.5)]"></span>
                            <span class="text-[11px] font-extrabold text-gray-800 capitalize">{{ Auth::user()->role ?? 'Administrator' }} Aktif</span>
                        </div>
                    </div>
                    <div class="p-2">
                        <a href="#" class="flex items-center gap-2.5 px-3 py-2.5 text-[12px] text-gray-600 hover:bg-[#F4F6FC] hover:text-[#0A3D74] rounded-xl font-bold transition-colors">
                            <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Profil Saya
                        </a>
                        <!-- Logout Action Menu -->
                        <form method="POST" action="{{ route('logout') }}" class="w-full mt-1">
                            @csrf
                            <button type="submit" class="flex items-center gap-2.5 w-full text-left px-3 py-2.5 text-[12px] text-red-500 hover:bg-red-50 hover:text-red-700 rounded-xl font-bold transition-colors">
                                <svg class="w-4 h-4 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Keluar Aplikasi
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </header>

        <!-- Main Content (Dashboard components) -->
        <main class="flex-1 overflow-y-auto px-4 pb-8 pr-12 pt-2">
            {{ $slot }}
        </main>
    </div>

</body>

</html>
