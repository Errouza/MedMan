<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-4">
        @csrf

        <div class="text-center mb-2">
            <h2 class="text-2xl font-[900] text-gray-900">Buat Akun Baru</h2>
            <p class="text-sm text-gray-500 font-medium mt-1">Lengkapi data untuk mendaftar di sistem klinik</p>
        </div>

        <!-- Name -->
        <div class="flex flex-col gap-1 w-full">
            <label for="name" class="text-[13px] font-extrabold text-[#0A3D74]">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Nama..." class="w-full border-[2.5px] border-[#E2E8F0] rounded-[10px] px-4 py-2.5 text-[14px] text-gray-800 font-bold focus:border-[#6A9DF6] focus:ring-0 placeholder-gray-400 transition-colors">
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div class="flex flex-col gap-1 w-full">
            <label for="email" class="text-[13px] font-extrabold text-[#0A3D74]">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="Email..." class="w-full border-[2.5px] border-[#E2E8F0] rounded-[10px] px-4 py-2.5 text-[14px] text-gray-800 font-bold focus:border-[#6A9DF6] focus:ring-0 placeholder-gray-400 transition-colors">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>
        
        <!-- Role -->
        <div class="flex flex-col gap-1 w-full">
            <label for="role" class="text-[13px] font-extrabold text-[#0A3D74]">Peran (Role)</label>
            <select id="role" name="role" required class="w-full border-[2.5px] border-[#E2E8F0] rounded-[10px] px-4 py-2.5 text-[14px] text-gray-800 font-bold focus:border-[#6A9DF6] focus:ring-0 transition-colors">
                <option value="admin">Admin / Pendaftaran</option>
                <option value="doctor">Dokter Praktik</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-1" />
        </div>

        <!-- Password -->
        <div class="flex flex-col gap-1 w-full" x-data="{ show: false }">
            <label for="password" class="text-[13px] font-extrabold text-[#0A3D74]">Password</label>
            <div class="relative">
                <input id="password" x-bind:type="show ? 'text' : 'password'" name="password" required autocomplete="new-password" placeholder="Password..." class="w-full border-[2.5px] border-[#E2E8F0] rounded-[10px] px-4 py-2.5 text-[14px] text-gray-800 font-bold focus:border-[#6A9DF6] focus:ring-0 placeholder-gray-400 transition-colors">
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <svg x-show="!show" class="h-5 w-5 text-gray-400 hover:text-[#6A9DF6]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    <svg x-show="show" style="display: none;" class="h-5 w-5 text-[#6A9DF6] hover:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div class="flex flex-col gap-1 w-full" x-data="{ show: false }">
            <label for="password_confirmation" class="text-[13px] font-extrabold text-[#0A3D74]">Konfirmasi Password</label>
            <div class="relative">
                <input id="password_confirmation" x-bind:type="show ? 'text' : 'password'" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi Password..." class="w-full border-[2.5px] border-[#E2E8F0] rounded-[10px] px-4 py-2.5 text-[14px] text-gray-800 font-bold focus:border-[#6A9DF6] focus:ring-0 placeholder-gray-400 transition-colors">
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <svg x-show="!show" class="h-5 w-5 text-gray-400 hover:text-[#6A9DF6]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    <svg x-show="show" style="display: none;" class="h-5 w-5 text-[#6A9DF6] hover:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="mt-4">
            <button type="submit" class="w-full bg-[#0A3D74] hover:bg-[#6A9DF6] text-white font-[900] text-[15px] py-3.5 rounded-[12px] transition-colors shadow-[0_4px_10px_rgba(10,61,116,0.2)] hover:shadow-[0_4px_15px_rgba(106,157,246,0.3)]">
                DAFTAR SEKARANG
            </button>
        </div>
        
        <div class="text-center mt-2">
            <p class="text-[13px] font-medium text-gray-500">Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-[#6A9DF6] hover:text-[#0A3D74] transition-colors">Masuk di sini</a></p>
        </div>
    </form>
</x-guest-layout>
