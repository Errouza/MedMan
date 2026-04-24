<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Klinik MedMan') }} - Authentication</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-['Poppins'] text-gray-800 antialiased bg-[#F4F6FC] h-screen flex items-center justify-center relative overflow-hidden">

    <!-- Background Accents -->
    <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-[#6A9DF6] opacity-10 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[600px] h-[600px] bg-[#0A3D74] opacity-5 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="w-full max-w-md z-10 px-6">
        <!-- Logo Header -->
        <div class="flex flex-col items-center mb-8">
            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-md overflow-hidden p-1 border-[4px] border-[#0A3D74] mb-4">
                <image src="{{ asset('images/logoApotek.svg') }}" alt="Logo" class="w-full h-full object-cover">
            </div>
            <h1 class="text-3xl font-[900] text-[#0A3D74] tracking-tight">Apotek Bubulak</h1>
            <p class="text-[14px] text-gray-500 font-medium mt-1">Sistem Manajemen Praktik Medis</p>
        </div>

        <!-- Auth Card -->
        <div class="w-full bg-white rounded-[24px] shadow-[0_10px_40px_rgba(0,0,0,0.04)] border border-gray-100 p-8 sm:p-10">
            {{ $slot }}
        </div>

        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-[12px] text-gray-400 font-medium">&copy; {{ date('Y') }} Klinik MedMan. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
