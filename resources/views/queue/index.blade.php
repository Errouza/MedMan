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

        <!-- Data Kunjungan Pasien (Moved from Patients Page) -->
        <div class="bg-white rounded-[24px] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 p-8 w-full">
            <h3 class="text-[20px] font-[900] text-[#0A3D74] mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 text-[#6A9DF6]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Data Kunjungan Pasien
            </h3>
            
            <!-- Search bar -->
            <div class="flex items-center w-full border-[2.5px] border-gray-200 focus-within:border-[#6A9DF6] transition-colors rounded-full overflow-hidden mb-8 h-14 bg-white">
                <div class="pl-6 text-gray-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" placeholder="Cari Nama Pasien, NIK, atau Rekam Medis..." class="flex-1 border-none px-4 text-[14px] font-bold text-gray-600 focus:ring-0 bg-transparent h-full placeholder-gray-400">
                <button class="bg-[#0A3D74] hover:bg-[#6A9DF6] text-white font-[900] text-[13px] px-8 h-full flex items-center justify-center transition-colors">
                    CARI DATA
                </button>
            </div>

            <!-- Table -->
            <div class="w-full overflow-x-auto">
                <table class="w-full text-left min-w-[800px]">
                    <thead>
                        <tr class="border-b-[3px] border-gray-100">
                            <th class="pb-4 px-2 text-[12px] font-[900] text-gray-400 uppercase tracking-widest">Rekam Medis</th>
                            <th class="pb-4 px-2 text-[12px] font-[900] text-gray-400 uppercase tracking-widest text-center">Kamar</th>
                            <th class="pb-4 px-2 text-[12px] font-[900] text-gray-400 uppercase tracking-widest">Nama Pasien</th>
                            <th class="pb-4 px-2 text-[12px] font-[900] text-gray-400 uppercase tracking-widest text-center">NIK</th>
                            <th class="pb-4 px-2 text-[12px] font-[900] text-gray-400 uppercase tracking-widest text-center">Tanggal</th>
                            <th class="pb-4 px-2 text-[12px] font-[900] text-gray-400 uppercase tracking-widest">Status</th>
                            <th class="pb-4 px-2"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-[2px] divide-gray-50">
                        @forelse($patients ?? [] as $index => $patient)
                        @php
                            $statuses = [
                                ['color' => 'bg-[#52C41A]', 'shadow' => 'shadow-[0_0_8px_rgba(82,196,26,0.4)]', 'text' => 'Done', 'btn' => 'Cek Aktifitas'],
                                ['color' => 'bg-[#F59E0B]', 'shadow' => 'shadow-[0_0_8px_rgba(245,158,11,0.4)]', 'text' => 'In Pro', 'btn' => 'Lakukan Tindakan'],
                                ['color' => 'bg-[#34D399]', 'shadow' => 'shadow-[0_0_8px_rgba(52,211,153,0.4)]', 'text' => 'Paid', 'btn' => 'Cek Aktifitas'],
                            ];
                            $s = $statuses[$index % 3];
                        @endphp
                        <tr class="hover:bg-blue-50 transition-colors group">
                            <td class="py-5 px-2 text-[14px] font-[800] text-[#0A3D74]">{{ $patient->medical_record_number }}</td>
                            <td class="py-5 px-2 text-[14px] font-[800] text-[#0A3D74] text-center">1</td>
                            <td class="py-5 px-2">
                                <div class="flex flex-col">
                                    <span class="text-[14px] font-[800] text-[#6A9DF6] group-hover:text-[#0A3D74] transition-colors">{{ $patient->name }}</span>
                                    <span class="text-[10px] font-bold text-gray-400 tracking-wide mt-0.5">{{ $patient->phone }} | {{ $patient->address ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="py-5 px-2 text-[14px] font-[800] text-[#0A3D74] text-center">{{ $patient->nik }}</td>
                            <td class="py-5 px-2 text-[13px] font-[800] text-gray-500 text-center">{{ $patient->created_at->format('j M H:i, Y') }}</td>
                            <td class="py-5 px-2">
                                <div class="flex items-center gap-2.5">
                                    <span class="w-3.5 h-3.5 rounded-full {{ $s['color'] }} {{ $s['shadow'] }}"></span>
                                    <span class="text-[14px] font-[900] text-gray-700 w-16 text-left">{{ $s['text'] }}</span>
                                </div>
                            </td>
                            <td class="py-5 px-2 text-right">
                                <button class="bg-[#6A9DF6] hover:bg-[#0A3D74] text-white font-[800] text-[11px] px-5 py-2.5 rounded-[10px] transition-colors shadow-sm tracking-widest uppercase">
                                    {{ $s['btn'] }}
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12 mb-3 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                    <span class="font-bold text-[14px]">Belum ada data kunjungan hari ini.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-clinic-layout>
