<x-clinic-layout>
    <div class="flex flex-col gap-6 w-full max-w-7xl mx-auto">
        
        <!-- Top Cards -->
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 w-full">
            
            <!-- Left Card: Stats -->
            <div class="xl:col-span-6 bg-white rounded-[24px] shadow-[0_0_15px_rgba(0,0,0,0.02)] border border-gray-100 p-8 flex flex-col sm:flex-row justify-around items-center min-h-[200px] gap-6 sm:gap-2">
                <div class="flex flex-col items-center justify-center text-center">
                    <span class="text-[14px] sm:text-[16px] font-[900] text-black mb-1">Jumlah Pasien Hari ini</span>
                    <span class="text-[60px] sm:text-[75px] font-[900] text-[#6A9DF6] leading-none tracking-tighter" style="font-family: 'Inter', sans-serif;">{{ \App\Models\Patient::whereDate('created_at', \Carbon\Carbon::today())->count() }}</span>
                </div>
                <!-- Divider for sm and up -->
                <div class="hidden sm:block w-[2px] h-20 bg-gray-100"></div>
                <!-- Divider for mobile -->
                <div class="block sm:hidden w-full h-[2px] bg-gray-100"></div>
                <div class="flex flex-col items-center justify-center text-center">
                    <span class="text-[14px] sm:text-[16px] font-[900] text-black mb-1">Total Antrian Sistem</span>
                    <span class="text-[60px] sm:text-[75px] font-[900] text-[#6A9DF6] leading-none tracking-tighter" style="font-family: 'Inter', sans-serif;">{{ \App\Models\Patient::count() }}</span>
                </div>
            </div>

            <!-- Right Card: Calendar/Mini Table -->
            <div class="xl:col-span-6 bg-white rounded-[24px] shadow-[0_0_15px_rgba(0,0,0,0.02)] border border-gray-100 p-8 flex flex-col sm:flex-row items-center gap-8 min-h-[200px]">
                <!-- Calendar Widget -->
                <div class="flex flex-col items-center justify-center w-20 shrink-0">
                    <div class="bg-[#6A9DF6] text-white rounded-[14px] w-full py-2 flex flex-col items-center justify-center overflow-hidden shadow-md">
                        <span class="text-[10px] font-bold uppercase mt-0.5 tracking-wider">{{ now()->translatedFormat('D') }}</span>
                        <span class="text-[28px] font-[900] leading-none my-1">{{ now()->format('j') }}</span>
                    </div>
                    <span class="text-[11px] font-[900] text-black mt-2 text-center leading-tight">{{ now()->translatedFormat('M Y') }}</span>
                    
                    <!-- Live Clock -->
                    <span id="liveClock" class="text-[11px] font-black text-[#0A3D74] bg-[#EBF4FF] px-2.5 py-1 rounded-full mt-1.5 border border-[#6A9DF6]/30 shadow-sm">
                        {{ now()->format('H:i') }}
                    </span>
                    <script>
                        let dashboardServerTime = {{ now()->timestamp }} * 1000;
                        setInterval(function() {
                            dashboardServerTime += 1000;
                            const d = new Date(dashboardServerTime);
                            const timeStr = String(d.getHours()).padStart(2, '0') + ':' + String(d.getMinutes()).padStart(2, '0');
                            const clockEl = document.getElementById('liveClock');
                            if(clockEl) clockEl.innerText = timeStr;
                        }, 1000);
                    </script>
                </div>
                
                <!-- Mini Table Jadwal -->
                <div class="flex-1 w-full" x-data="{ 
                    schedules: JSON.parse(localStorage.getItem('doctorSchedules')) || [
                        { time: '08:00 - 13:00', doctor: 'dr. Andini (Pagi)', isActive: true },
                        { time: '16:00 - 21:00', doctor: 'dr. Andini (Malam)', isActive: false }
                    ],
                    save() {
                        localStorage.setItem('doctorSchedules', JSON.stringify(this.schedules));
                    },
                    addSchedule() {
                        this.schedules.push({ time: '', doctor: '', isActive: true });
                        this.save();
                    },
                    removeSchedule(index) {
                        this.schedules.splice(index, 1);
                        this.save();
                    },
                    init() {
                        window.addEventListener('storage', (e) => {
                            if (e.key === 'doctorSchedules' && e.newValue) {
                                this.schedules = JSON.parse(e.newValue);
                            }
                        });
                    }
                }">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-[14px] font-[900] text-[#0A3D74]">Jadwal Dokter Hari Ini</h3>
                        <button @click="addSchedule" class="text-[10px] bg-[#6A9DF6]/20 text-[#0A3D74] px-2 py-1 rounded-md font-bold hover:bg-[#6A9DF6] hover:text-white transition-colors">+ Tambah</button>
                    </div>
                    <div class="flex flex-col gap-2 max-h-[110px] overflow-y-auto pr-2" style="scrollbar-width: thin;">
                        <template x-for="(schedule, index) in schedules" :key="index">
                            <div class="flex justify-between items-center bg-blue-50/50 p-2.5 pr-6 rounded-lg border border-blue-100 relative group">
                                <div class="flex items-center gap-2">
                                    <button type="button" @click="schedule.isActive = !schedule.isActive; save()" class="w-2.5 h-2.5 rounded-full shrink-0 transition-colors" :class="schedule.isActive ? 'bg-green-500' : 'bg-gray-400'" title="Toggle Status Aktif"></button>
                                    <input type="text" x-model="schedule.time" @input="save()" class="text-[12px] font-bold text-gray-700 bg-transparent border-none p-0 focus:ring-0 w-24 placeholder-gray-400" placeholder="08:00 - 13:00">
                                </div>
                                <input type="text" x-model="schedule.doctor" @input="save()" class="text-[12px] font-[900] text-[#0A3D74] bg-transparent border-none p-0 focus:ring-0 w-32 text-right placeholder-blue-300" placeholder="Nama Dokter">
                                
                                <button type="button" @click="removeSchedule(index)" class="absolute right-1.5 top-1/2 -translate-y-1/2 bg-red-500 text-white w-4 h-4 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow-sm z-10" title="Hapus Jadwal">
                                    <svg class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                        </template>
                        <div x-show="schedules.length === 0" class="text-center text-[11px] text-gray-400 italic py-2">
                            Belum ada jadwal dokter.
                        </div>
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
                            <th class="pb-4 px-2 text-[12px] font-[900] text-gray-400 uppercase tracking-widest text-center">No. Urut</th>
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
                            // Determine status
                            $s = ['color' => '', 'shadow' => '', 'text' => '', 'btn' => ''];
                            
                            switch($patient->status) {
                                case 'waiting':
                                    $s = ['color' => 'bg-[#F59E0B]', 'shadow' => 'shadow-[0_0_8px_rgba(245,158,11,0.4)]', 'text' => 'Menunggu', 'btn' => '-'];
                                    break;
                                case 'in_progress':
                                    $s = ['color' => 'bg-[#3B82F6]', 'shadow' => 'shadow-[0_0_8px_rgba(59,130,246,0.4)]', 'text' => 'Diperiksa', 'btn' => '-'];
                                    break;
                                case 'checked':
                                    $s = ['color' => 'bg-[#10B981]', 'shadow' => 'shadow-[0_0_8px_rgba(16,185,129,0.4)]', 'text' => 'Tagihan', 'btn' => 'Proses Pembayaran'];
                                    break;
                                case 'completed':
                                    $s = ['color' => 'bg-gray-400', 'shadow' => '', 'text' => 'Lunas', 'btn' => 'Lihat Data'];
                                    break;
                            }
                        @endphp
                        <tr class="hover:bg-blue-50 transition-colors group">
                            <td class="py-5 px-2 text-[14px] font-[800] text-[#0A3D74]">{{ $patient->medical_record_number }}</td>
                            <td class="py-5 px-2 text-center">
                                <span class="w-8 h-8 rounded-full bg-[#EBF4FF] text-[#0A3D74] font-black text-[13px] flex items-center justify-center border border-[#6A9DF6]/30 mx-auto">
                                    {{ $patient->queue_number }}
                                </span>
                            </td>
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
                                    <span class="text-[14px] font-[900] text-gray-700 w-20 text-left">{{ $s['text'] }}</span>
                                </div>
                            </td>
                            <td class="py-5 px-2 text-right">
                                @if($patient->status === 'checked')
                                <a href="{{ route('billing.show', $patient) }}" class="bg-[#10B981] hover:bg-[#059669] text-white text-[11px] font-[900] px-4 py-2 rounded-[8px] transition-colors shadow-sm uppercase tracking-wide inline-block whitespace-nowrap">
                                    Proses Pembayaran
                                </a>
                                @elseif($patient->status === 'completed')
                                <a href="{{ route('patients.show', $patient) }}" class="bg-[#6A9DF6] hover:bg-[#0A3D74] text-white font-[800] text-[11px] px-5 py-2.5 rounded-[10px] transition-colors shadow-sm tracking-widest uppercase whitespace-nowrap inline-block">
                                    Lihat Data
                                </a>
                                @else
                                <span class="text-gray-300">-</span>
                                @endif
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
