<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Klinik MedMan') }} - Dokter</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F4F6FC] font-['Poppins'] text-gray-800 antialiased min-h-screen flex flex-col items-center pt-8 pb-12">

    <div class="w-full max-w-7xl mx-auto flex flex-col gap-6 px-4 xl:px-0">
        <!-- Header Praktek Dokter -->
        <div class="flex items-center justify-between bg-transparent px-4">
            <div class="flex items-center gap-5">
                <!-- Logo placeholder -->
                <div class="w-[70px] h-[70px] bg-white rounded-full shadow-md border border-gray-100 flex items-center justify-center p-1.5 shrink-0">
                    <div class="w-full h-full border-2 border-[#6A9DF6] rounded-full flex items-center justify-center bg-[#EBF4FF] text-[#0A3D74]">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                </div>
                <div class="flex flex-col">
                    <h1 class="text-[22px] font-[900] text-black tracking-tight uppercase leading-tight">PRAKTER DOKTER MANDIRI "APOTEK BUBULAK"</h1>
                    <p class="text-[13px] font-bold text-gray-500 mt-1">Jl. Bubulak, Bogor Jawa Barat</p>
                </div>
            </div>
            
            <div class="flex items-center gap-6">
                <div class="text-right flex flex-col">
                    <p class="text-[12px] font-extrabold text-gray-500">Selamat Datang,</p>
                    <p class="text-[16px] font-[900] text-black mt-0.5">{{ Auth::user()->name ?? 'dr. Andini Hurul Aini' }}</p>
                </div>
                
                <!-- Logout Action -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-10 h-10 bg-red-50 text-red-500 rounded-full flex items-center justify-center hover:bg-red-500 hover:text-white transition-colors shadow-sm" title="Keluar">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        </div>

        <!-- Tab Navigation & Content Container -->
        <div class="relative w-full mt-12">
            <!-- Folder Tabs -->
            <div class="flex items-end gap-3 px-10 absolute -top-11 left-0 right-0 z-0">
                <!-- Tab 1 -->
                <a href="{{ route('patients.index') }}" class="{{ request()->routeIs('patients.*') ? 'bg-white border-t-[3px] border-[#6A9DF6] text-[#6A9DF6] cursor-default' : 'bg-[#6A9DF6] hover:bg-[#5b8ce0] text-white cursor-pointer shadow-sm' }} font-[800] text-[14px] px-10 py-3 rounded-t-[14px] transition-colors">
                    Daftar Pasien
                </a>
                <!-- Tab 2 -->
                <a href="#" class="bg-[#6A9DF6] hover:bg-[#5b8ce0] cursor-pointer text-white font-[800] text-[14px] px-8 py-2.5 rounded-t-[14px] transition-colors shadow-sm">
                    Pelayanan Pasien
                </a>
                <!-- Tab 3 -->
                <a href="#" class="bg-[#6A9DF6] hover:bg-[#5b8ce0] cursor-pointer text-white font-[800] text-[14px] px-8 py-2.5 rounded-t-[14px] transition-colors shadow-sm">
                    Buat Resep
                </a>
                <!-- Tab 4 -->
                <a href="#" class="bg-[#6A9DF6] hover:bg-[#5b8ce0] cursor-pointer text-white font-[800] text-[14px] px-8 py-2.5 rounded-t-[14px] transition-colors shadow-sm">
                    Surat Keterangan
                </a>
            </div>

            <!-- Main Content Box -->
            <div class="bg-white rounded-[24px] shadow-[0_8px_30px_rgba(0,0,0,0.03)] border border-gray-100 p-8 pt-10 w-full relative z-10 min-h-[500px]">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
