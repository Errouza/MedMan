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
                        <img src="{{ asset('images/logoApotek.svg') }}" alt="Logo" class="w-full h-full object-cover">
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
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <!-- Tab Navigation & Content Container -->
        <div class="w-full mt-8 flex flex-col">
            <!-- Folder Tabs -->
            <div class="flex items-end gap-2 px-10 relative z-20 -mb-[1px]">
                <!-- Tab 1 -->
                <a href="{{ route('patients.index') }}" class="{{ request()->routeIs('patients.index') ? 'bg-white border-t-[3px] border-[#6A9DF6] border-x border-gray-100 border-b-0 text-[#6A9DF6] pb-[13px] pt-3 px-8' : 'bg-[#6A9DF6] hover:bg-[#5b8ce0] text-white pb-2.5 pt-2.5 px-7 border border-transparent' }} rounded-t-[16px] font-[800] text-[14px] transition-all relative">
                    <!-- active tab mask for bottom border -->
                    @if(request()->routeIs('patients.index'))
                    <div class="absolute -bottom-[2px] left-0 right-0 h-[3px] bg-white"></div>
                    @endif
                    Daftar Pasien
                </a>
                <!-- Tab 2 -->
                <a href="{{ route('pelayanan.index') }}" class="{{ request()->routeIs('patients.diagnose') || request()->routeIs('pelayanan.index') ? 'bg-white border-t-[3px] border-[#6A9DF6] border-x border-gray-100 border-b-0 text-[#6A9DF6] pb-[13px] pt-3 px-8' : 'bg-[#6A9DF6] hover:bg-[#5b8ce0] text-white pb-2.5 pt-2.5 px-7 border border-transparent' }} rounded-t-[16px] font-[800] text-[14px] transition-all relative">
                    <!-- active tab mask for bottom border -->
                    @if(request()->routeIs('patients.diagnose') || request()->routeIs('pelayanan.index'))
                    <div class="absolute -bottom-[2px] left-0 right-0 h-[3px] bg-white"></div>
                    @endif
                    Pelayanan Pasien
                </a>

                <!-- Tab 4 -->
                <a href="{{ route('certificates.index') }}" class="{{ request()->routeIs('certificates.index') ? 'bg-white border-t-[3px] border-[#6A9DF6] border-x border-gray-100 border-b-0 text-[#6A9DF6] pb-[13px] pt-3 px-8' : 'bg-[#6A9DF6] hover:bg-[#5b8ce0] text-white pb-2.5 pt-2.5 px-7 border border-transparent' }} rounded-t-[16px] font-[800] text-[14px] transition-all relative">
                    @if(request()->routeIs('certificates.index'))
                    <div class="absolute -bottom-[2px] left-0 right-0 h-[3px] bg-white"></div>
                    @endif
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
