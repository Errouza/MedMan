<x-clinic-layout>
    <div x-data="{ isNoteModalOpen: false }">
    <!-- Header Page -->
    <div class="flex justify-between items-end mb-6 mt-4">
        <div>
            <h2 class="text-[26px] font-bold text-gray-900 leading-tight">Dashboard Klinik</h2>
            <p class="text-[13px] text-gray-400 font-medium mt-1">Pantau aktivitas, jadwal dokter, dan antrean pasien hari ini</p>
        </div>
        <div class="flex gap-3">
            <button @click="isNoteModalOpen = true" class="bg-[#0A3D74] hover:bg-[#6A9DF6] text-white text-[13px] font-bold px-6 py-2.5 rounded-full transition-colors flex items-center gap-2 shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Catatan
            </button>
        </div>
    </div>

    <!-- Top Cards -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 w-full mb-6">
        
        <!-- Stats Card -->
        <div class="xl:col-span-4 bg-white rounded-[24px] shadow-[0_0_15px_rgba(0,0,0,0.02)] border border-gray-100 p-6 flex justify-around items-center h-[180px]">
            <div class="flex flex-col items-center justify-center">
                <span class="text-[13px] font-[900] text-gray-500 mb-1 text-center">Pasien<br>Hari ini</span>
                <span class="text-[55px] font-[900] text-[#6A9DF6] leading-none tracking-tighter drop-shadow-sm">{{ \App\Models\Patient::whereDate('created_at', \Carbon\Carbon::today())->count() }}</span>
            </div>
            <div class="w-[2px] h-20 bg-gray-100"></div>
            <div class="flex flex-col items-center justify-center">
                <span class="text-[13px] font-[900] text-gray-500 mb-1 text-center">Total<br>Antrian</span>
                <span class="text-[55px] font-[900] text-[#0A3D74] leading-none tracking-tighter drop-shadow-sm">{{ \App\Models\Patient::count() }}</span>
            </div>
        </div>

        <!-- Calendar & Schedule Card -->
        <div class="xl:col-span-5 bg-white rounded-[24px] shadow-[0_0_15px_rgba(0,0,0,0.02)] border border-gray-100 p-6 flex items-center gap-6 h-[180px]">
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
                    setInterval(function() {
                        const d = new Date();
                        const timeStr = String(d.getHours()).padStart(2, '0') + ':' + String(d.getMinutes()).padStart(2, '0');
                        const clockEl = document.getElementById('liveClock');
                        if(clockEl) clockEl.innerText = timeStr;
                    }, 1000);
                </script>
            </div>
            
            <!-- Mini Table Jadwal -->
            <div class="flex-1">
                <h3 class="text-[14px] font-[900] text-[#0A3D74] mb-3">Jadwal Dokter Hari Ini</h3>
                <div class="flex flex-col gap-2">
                    <div class="flex justify-between items-center bg-blue-50/50 p-2.5 rounded-lg border border-blue-100">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-green-500"></div>
                            <span class="text-[12px] font-bold text-gray-700">08:00 - 13:00</span>
                        </div>
                        <span class="text-[12px] font-[900] text-[#0A3D74]">dr. Andini (Pagi)</span>
                    </div>
                    <div class="flex justify-between items-center bg-gray-50 p-2.5 rounded-lg border border-gray-100">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-gray-400"></div>
                            <span class="text-[12px] font-bold text-gray-700">16:00 - 21:00</span>
                        </div>
                        <span class="text-[12px] font-[900] text-gray-500">dr. Andini (Malam)</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reminder / Sticky Note Card -->
        <div class="xl:col-span-3 bg-[#FFFBEB] rounded-[24px] shadow-[0_4px_15px_rgba(251,191,36,0.1)] border border-[#FDE68A] p-6 flex flex-col h-[180px] relative overflow-hidden">
            <div class="absolute top-0 right-0 w-10 h-10 bg-[#FCD34D] rounded-bl-[20px] opacity-50 z-0"></div>
            
            <div class="flex items-center gap-2 mb-3 relative z-10 shrink-0">
                <svg class="w-4 h-4 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                <h3 class="text-[13px] font-[900] text-yellow-800 tracking-wide uppercase">Pengingat</h3>
            </div>
            
            <div class="flex-1 overflow-y-auto pr-2 relative z-10 custom-scrollbar flex flex-col gap-4">
                @php
                    $notes = \App\Models\Note::latest()->get();
                @endphp
                
                @forelse($notes as $note)
                    <div class="group relative border-b border-yellow-200/50 pb-3 last:border-0 last:pb-0">
                        <div class="text-[14px] font-extrabold text-gray-800 leading-snug pr-6">{{ $note->content }}</div>
                        @if($note->deadline)
                            <p class="text-[11px] text-yellow-600 font-bold mt-1.5 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Batas: {{ $note->deadline->format('d M, H:i') }}
                            </p>
                        @endif
                        
                        <!-- Delete Button (shows on hover) -->
                        <form action="{{ route('notes.destroy', $note) }}" method="POST" class="absolute top-0 right-0 opacity-0 group-hover:opacity-100 transition-opacity">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-600 p-1 bg-red-50 hover:bg-red-100 rounded-md transition-colors" title="Hapus Catatan">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="flex items-center justify-center h-full text-[12px] font-bold text-yellow-700/50">
                        Belum ada catatan.
                    </div>
                @endforelse
            </div>
        </div>
        
    </div>

    <!-- Data Antrean Live -->
    <div class="bg-white rounded-[24px] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 p-8 w-full mb-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-[18px] font-[900] text-[#0A3D74] flex items-center gap-2">
                <svg class="w-5 h-5 text-[#6A9DF6]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Antrean Pasien Live
            </h3>
            <a href="{{ route('patients.index') }}" class="text-[12px] font-bold text-[#6A9DF6] hover:text-[#0A3D74] transition-colors underline underline-offset-2">Lihat Semua Data Pasien</a>
        </div>
        
        <!-- Table -->
        <div class="w-full overflow-x-auto">
            <table class="w-full text-left min-w-[800px]">
                <thead>
                    <tr class="border-b-[2px] border-gray-100">
                        <th class="pb-4 px-2 text-[12px] font-[900] text-gray-400 uppercase tracking-widest">No. Urut</th>
                        <th class="pb-4 px-2 text-[12px] font-[900] text-gray-400 uppercase tracking-widest">Nama Pasien</th>
                        <th class="pb-4 px-2 text-[12px] font-[900] text-gray-400 uppercase tracking-widest text-center">Rekam Medis</th>
                        <th class="pb-4 px-2 text-[12px] font-[900] text-gray-400 uppercase tracking-widest text-center">Waktu Daftar</th>
                        <th class="pb-4 px-2 text-[12px] font-[900] text-gray-400 uppercase tracking-widest">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y-[2px] divide-gray-50">
                    @php
                        // Fetch today's patients for live queue
                        $todayPatients = \App\Models\Patient::whereDate('created_at', \Carbon\Carbon::today())->latest()->get();
                    @endphp
                    
                    @forelse($todayPatients as $index => $patient)
                    @php
                        // Determine status based on 'tindakan'
                        $isDone = !is_null($patient->tindakan);
                        $statusColor = $isDone ? 'bg-[#52C41A]' : 'bg-[#F59E0B]';
                        $statusShadow = $isDone ? 'shadow-[0_0_8px_rgba(82,196,26,0.4)]' : 'shadow-[0_0_8px_rgba(245,158,11,0.4)]';
                        $statusText = $isDone ? 'Selesai' : 'Menunggu';
                    @endphp
                    <tr class="hover:bg-blue-50/50 transition-colors group">
                        <td class="py-5 px-2">
                            <span class="w-8 h-8 rounded-full bg-[#EBF4FF] text-[#0A3D74] font-black text-[13px] flex items-center justify-center border border-[#6A9DF6]/30">
                                {{ $todayPatients->count() - $index }}
                            </span>
                        </td>
                        <td class="py-5 px-2">
                            <div class="flex flex-col">
                                <span class="text-[14px] font-[800] text-[#0A3D74]">{{ $patient->name }}</span>
                                <span class="text-[11px] font-bold text-gray-400 tracking-wide mt-0.5">NIK: {{ $patient->nik }}</span>
                            </div>
                        </td>
                        <td class="py-5 px-2 text-[14px] font-[800] text-[#6A9DF6] text-center">{{ $patient->medical_record_number }}</td>
                        <td class="py-5 px-2 text-[13px] font-[800] text-gray-500 text-center">{{ $patient->created_at->format('H:i') }} WIB</td>
                        <td class="py-5 px-2">
                            <div class="flex items-center gap-2.5">
                                <span class="w-3 h-3 rounded-full {{ $statusColor }} {{ $statusShadow }}"></span>
                                <span class="text-[13px] font-[900] text-gray-700 w-20">{{ $statusText }}</span>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-16 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <svg class="w-12 h-12 mb-3 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="font-bold text-[14px]">Belum ada antrean pasien hari ini.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Catatan -->
    <div x-show="isNoteModalOpen" style="display: none;" class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Background overlay -->
        <div x-show="isNoteModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <!-- Modal panel -->
            <div x-show="isNoteModalOpen" @click.away="isNoteModalOpen = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-[24px] bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-100">
                
                <div class="bg-white px-8 pb-8 pt-8">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-yellow-50 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                            <h3 class="text-[18px] font-[900] leading-6 text-[#0A3D74]" id="modal-title">Tambah Pengingat Baru</h3>
                            <div class="mt-2">
                                <p class="text-[13px] text-gray-500 font-bold mb-5">Tambahkan catatan penting atau pengingat jadwal ke dashboard.</p>
                                
                                <form action="{{ route('notes.store') }}" method="POST" id="addNoteForm">
                                    @csrf
                                    
                                    <div class="flex flex-col gap-4">
                                        <div class="flex flex-col gap-1.5">
                                            <label for="content" class="text-[13px] font-extrabold text-[#0A3D74]">Isi Catatan <span class="text-red-500">*</span></label>
                                            <textarea name="content" id="content" rows="3" required class="w-full border-[2px] border-gray-200 rounded-[12px] px-4 py-3 text-[14px] text-gray-800 font-bold focus:border-[#6A9DF6] focus:ring-0 placeholder-gray-400 transition-colors resize-none" placeholder="Contoh: Cek stok obat Paracetamol"></textarea>
                                        </div>
                                        
                                        <div class="flex flex-col gap-1.5">
                                            <label for="deadline" class="text-[13px] font-extrabold text-[#0A3D74]">Batas Waktu (Opsional)</label>
                                            <input type="datetime-local" name="deadline" id="deadline" class="w-full border-[2px] border-gray-200 rounded-[12px] px-4 py-3 text-[14px] text-gray-800 font-bold focus:border-[#6A9DF6] focus:ring-0 transition-colors">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-8 py-5 sm:flex sm:flex-row-reverse border-t border-gray-100">
                    <button type="submit" form="addNoteForm" class="inline-flex w-full justify-center rounded-[12px] bg-[#0A3D74] px-6 py-3 text-[13px] font-[900] text-white shadow-sm hover:bg-[#6A9DF6] transition-colors sm:ml-3 sm:w-auto tracking-wide">Simpan Catatan</button>
                    <button type="button" @click="isNoteModalOpen = false" class="mt-3 inline-flex w-full justify-center rounded-[12px] bg-white px-6 py-3 text-[13px] font-[900] text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors">Batal</button>
                </div>
            </div>
        </div>
    </div>

    </div>
</x-clinic-layout>
