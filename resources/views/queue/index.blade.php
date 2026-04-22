<x-clinic-layout>
    <div class="flex flex-col gap-6 w-full max-w-7xl mx-auto">
        
        <!-- Top Cards -->
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 w-full">
            
            <!-- Left Card: Stats -->
            <div class="xl:col-span-6 bg-white rounded-[24px] shadow-[0_0_15px_rgba(0,0,0,0.02)] border border-gray-100 p-8 flex justify-around items-center h-[200px]">
                <div class="flex flex-col items-center justify-center">
                    <span class="text-[16px] font-[900] text-black mb-1">Jumlah Pasien Hari ini</span>
                    <span class="text-[75px] font-[900] text-[#6A9DF6] leading-none tracking-tighter" style="font-family: 'Inter', sans-serif;">{{ \App\Models\Patient::whereDate('created_at', \Carbon\Carbon::today())->count() }}</span>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <span class="text-[16px] font-[900] text-black mb-1">Total Antrian Sistem</span>
                    <span class="text-[75px] font-[900] text-[#6A9DF6] leading-none tracking-tighter" style="font-family: 'Inter', sans-serif;">{{ \App\Models\Patient::count() }}</span>
                </div>
            </div>

            <!-- Right Card: Calendar/Mini Table -->
            <div class="xl:col-span-6 bg-white rounded-[24px] shadow-[0_0_15px_rgba(0,0,0,0.02)] border border-gray-100 p-8 flex items-center gap-8 h-[200px]">
                <!-- Calendar Widget -->
                <div class="flex flex-col items-center justify-center w-24">
                    <!-- Blue Box -->
                    <div class="bg-[#6A9DF6] text-white rounded-md w-[50px] h-[60px] flex flex-col items-center justify-center overflow-hidden shadow-sm">
                        <span class="text-[10px] font-bold lowercase mt-1">{{ now()->format('D') }}</span>
                        <span class="text-[32px] font-bold leading-none mb-1">{{ now()->format('j') }}</span>
                    </div>
                    <span class="text-[11px] font-[900] text-black mt-2 text-center leading-tight">{{ now()->translatedFormat('F Y') }}</span>
                    
                    <!-- Live Clock -->
                    <span id="liveClock" class="text-[12px] font-black text-[#0A3D74] bg-[#EBF4FF] px-2 py-0.5 rounded-full mt-1 border border-[#6A9DF6] shadow-sm">
                        {{ now()->format('H:i:s') }}
                    </span>
                    
                    <script>
                        setInterval(function() {
                            const d = new Date();
                            const timeStr = String(d.getHours()).padStart(2, '0') + ':' + 
                                            String(d.getMinutes()).padStart(2, '0') + ':' + 
                                            String(d.getSeconds()).padStart(2, '0');
                            const clockEl = document.getElementById('liveClock');
                            if(clockEl) clockEl.innerText = timeStr;
                        }, 1000);
                    </script>
                </div>
                
                <!-- Mini Table -->
                <div class="flex-1 max-w-[300px]">
                    <div class="w-full bg-white">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr>
                                    <th class="bg-[#6A9DF6] border border-gray-300 h-7 px-3 text-white text-left font-extrabold text-[10px] uppercase tracking-wider">Tanggal & Jam</th>
                                    <th class="bg-[#6A9DF6] border border-gray-300 h-7 px-3 text-white text-left font-extrabold text-[10px] uppercase tracking-wider">Jadwal Dokter</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border border-gray-300 h-7 px-3 text-[10px] text-gray-700 font-bold">{{ now()->translatedFormat('d F Y') }} <span class="text-blue-500">(08:00 - 13:00)</span></td>
                                    <td class="border border-gray-300 h-7 px-3 text-[10px] text-[#0A3D74] font-extrabold">{{ Auth::user()->name ?? 'dr. Andini (Sesi Pagi)' }}</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 h-7 px-3 text-[10px] text-gray-700 font-bold">{{ now()->translatedFormat('d F Y') }} <span class="text-blue-500">(16:00 - 21:00)</span></td>
                                    <td class="border border-gray-300 h-7 px-3 text-[10px] text-[#0A3D74] font-extrabold">{{ Auth::user()->name ?? 'dr. Andini (Sesi Malam)' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>

        <!-- Bottom Container: Visit List -->
        <div class="bg-white rounded-[24px] shadow-[0_0_15px_rgba(0,0,0,0.02)] border border-gray-100 p-8 w-full min-h-[500px]">
            <div class="flex flex-col gap-8">
                
                @forelse($patients ?? [] as $patient)
                <div class="flex flex-row items-center justify-between w-full border-b border-gray-50 pb-6 last:border-0 last:pb-0">
                    
                    <!-- Avatar & Info -->
                    <div class="flex items-center gap-5 w-[45%]">
                        <!-- Avatar Placeholder -->
                        <div class="w-[60px] h-[60px] rounded-full bg-[#E2E2E2] flex-shrink-0 flex items-end justify-center overflow-hidden">
                            <!-- Silhouette Head & Body -->
                            <svg class="w-12 h-14 text-[#999999] translate-y-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                            </svg>
                        </div>
                        
                        <!-- Text Info -->
                        <div class="flex flex-col">
                            <span class="text-[17px] font-semibold text-[#6A9DF6] leading-tight mb-0.5" style="letter-spacing: 0.2px;">{{ $patient->name }}</span>
                            <span class="text-[11px] text-[#333333] font-medium leading-[1.3]">{{ $patient->phone }} | {{ $patient->address ?? '-' }}</span>
                            <span class="text-[11px] text-[#333333] font-medium leading-[1.3]">Keluhan : {{ $patient->gejala ?? 'Belum ada keluhan' }}</span>
                        </div>
                    </div>

                    <!-- Date Area -->
                    <div class="w-[30%] flex justify-center">
                        <span class="text-[20px] font-medium text-[#6A9DF6]" style="letter-spacing: 0.5px;">{{ $patient->created_at->format('j M H:i, Y') }}</span>
                    </div>

                    <!-- Status Area -->
                    <div class="w-[25%] flex items-center justify-end gap-3 pr-[5%]">
                         <span class="w-[20px] h-[20px] rounded-full {{ $patient->tindakan ? 'bg-[#52C41A]' : 'bg-gray-400' }}"></span>
                         <span class="text-[20px] font-medium {{ $patient->tindakan ? 'text-[#6A9DF6]' : 'text-gray-500' }}">{{ $patient->tindakan ? 'Done' : 'Waiting' }}</span>
                    </div>

                </div>
                @empty
                <div class="flex items-center justify-center py-20">
                    <span class="text-xl font-bold text-gray-400">Belum ada pasien yang terdaftar di antrean hari ini.</span>
                </div>
                @endforelse
            </div>
        </div>

    </div>
</x-clinic-layout>
