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
<body class="bg-[#F4F6FC] font-['Poppins'] text-gray-800 antialiased h-screen overflow-hidden flex flex-col">

    <!-- Header / Navbar -->
    <header class="bg-[#F4F6FC] h-24 flex items-center justify-between px-8 flex-shrink-0 relative z-10 w-full pl-[110px]">
        <div class="flex items-center gap-4">
            <!-- Logo Icon -->
            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center border-4 border-blue-500 shadow-sm overflow-hidden p-1">
                <div class="w-full h-full rounded-full border border-gray-200 flex items-center justify-center bg-blue-50 text-blue-500">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path></svg>
                </div>
            </div>
            
            <div class="flex flex-col">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900 leading-tight">PRAKTER DOKTER MANDIRI "APOTEK BUBULAK"</h1>
                <p class="text-xs text-gray-600 font-medium">Jl. Bubulak, Bogor Jawa Barat</p>
            </div>
        </div>

        <div class="flex flex-col text-right">
            <span class="text-xs text-gray-600 font-semibold mb-0.5">Selamat Datang,</span>
            <span class="text-lg font-bold text-gray-900 border-b-2 border-transparent hover:border-gray-300 cursor-pointer">{{ Auth::user()->name ?? 'dr. Andini Hurul Aini' }}</span>
        </div>
    </header>

    <div class="flex flex-1 h-full relative">
        <!-- Sidebar -->
        <aside class="w-24 bg-[#6A9DF6] rounded-tr-3xl h-full flex flex-col items-center py-6 text-white absolute left-0 top-0 bottom-0 z-20 shadow-lg" style="margin-top:-96px; padding-top:110px; height: calc(100% + 96px);">
            <!-- Menu Items -->
            <nav class="flex flex-col gap-6 w-full mt-4">
                
                <!-- Dashboard (Active) -->
                <a href="{{ route('dashboard') }}" class="group relative flex flex-col items-center justify-center w-full cursor-pointer hover:bg-white/10 transition-colors py-3">
                    <span class="text-[10px] font-semibold mb-1 opacity-90">Dashboard</span>
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M11.47 3.84a.75.75 0 011.06 0l8.99 9A.75.75 0 1120.46 14l-1.25-1.25V20a2 2 0 01-2 2h-3v-5a1 1 0 00-1-1h-2a1 1 0 00-1 1v5H7a2 2 0 01-2-2v-7.25L3.75 14a.75.75 0 01-1.06-1.06l8.78-9z"></path></svg>
                    <!-- Active Indicator Arrow -->
                    @if(request()->routeIs('dashboard'))
                        <svg class="absolute right-[-12px] top-1/2 -translate-y-1/2 w-7 h-9 text-[#8ED1FC] drop-shadow-sm" viewBox="0 0 26 36" fill="currentColor" stroke="white" stroke-width="4" stroke-linejoin="round">
                            <path d="M24 3 L4 18 L24 33 Z" />
                        </svg>
                    @endif
                </a>

                <!-- Pasien -->
                <a href="{{ route('patients.index') }}" class="group relative flex flex-col items-center justify-center w-full cursor-pointer hover:bg-white/10 transition-colors py-3">
                    <span class="text-[10px] font-semibold mb-1 opacity-90">Pasien</span>
                    <div class="relative">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path></svg>
                        <svg class="w-4 h-4 absolute -bottom-1 -right-1 text-white bg-[#6A9DF6] rounded-full" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path></svg>
                    </div>
                    @if(request()->routeIs('patients.*'))
                        <svg class="absolute right-[-12px] top-1/2 -translate-y-1/2 w-7 h-9 text-[#8ED1FC] drop-shadow-sm" viewBox="0 0 26 36" fill="currentColor" stroke="white" stroke-width="4" stroke-linejoin="round">
                            <path d="M24 3 L4 18 L24 33 Z" />
                        </svg>
                    @endif
                </a>

                <!-- Kunjungan -->
                <a href="{{ route('queue.index') }}" class="group relative flex flex-col items-center justify-center w-full cursor-pointer hover:bg-white/10 transition-colors py-3">
                    <span class="text-[10px] font-semibold mb-1 opacity-90">Kunjungan</span>
                    <div class="relative">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-2h2v2zm0-4H7v-2h2v2zm0-4H7V7h2v2zm4 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V7h2v2zm4 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V7h2v2z"/></svg>
                        <svg class="w-4 h-4 absolute -bottom-1 -right-1 text-white bg-[#6A9DF6] rounded-full" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path></svg>
                    </div>
                    @if(request()->routeIs('queue.*'))
                        <svg class="absolute right-[-12px] top-1/2 -translate-y-1/2 w-7 h-9 text-[#8ED1FC] drop-shadow-sm" viewBox="0 0 26 36" fill="currentColor" stroke="white" stroke-width="4" stroke-linejoin="round">
                            <path d="M24 3 L4 18 L24 33 Z" />
                        </svg>
                    @endif
                </a>

                <!-- Stok -->
                <a href="#" class="group relative flex flex-col items-center justify-center w-full cursor-pointer hover:bg-white/10 transition-colors py-3">
                    <span class="text-[10px] font-semibold mb-1 opacity-90">Stok</span>
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M3 5v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.11 0-2 .9-2 2zm12 4c0 1.66-1.34 3-3 3s-3-1.34-3-3V5h6v4z"/></svg>
                    @if(request()->routeIs('stock.*'))
                        <svg class="absolute right-[-12px] top-1/2 -translate-y-1/2 w-7 h-9 text-[#8ED1FC] drop-shadow-sm" viewBox="0 0 26 36" fill="currentColor" stroke="white" stroke-width="4" stroke-linejoin="round">
                            <path d="M24 3 L4 18 L24 33 Z" />
                        </svg>
                    @endif
                </a>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto pl-28 pr-8 pb-8 pt-4">
            {{ $slot }}
        </main>
    </div>

</body>
</html>
