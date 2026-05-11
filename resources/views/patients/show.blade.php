<x-clinic-layout>
    <div class="w-full max-w-5xl mx-auto py-8">
        <!-- Back Button -->
        <a href="{{ route('patients.index') }}" class="inline-flex items-center gap-2 text-[13px] font-[900] text-gray-500 hover:text-[#0A3D74] mb-6 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Pencarian Pasien
        </a>

        <!-- Identitas Pasien -->
        <div class="bg-white rounded-[24px] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 p-8 mb-8 relative overflow-hidden">
            <div class="absolute right-0 top-0 w-32 h-32 bg-blue-50 rounded-bl-[100px] -z-10 opacity-50"></div>
            
            <div class="flex items-start justify-between">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 bg-[#0A3D74] rounded-full flex items-center justify-center text-white font-black text-3xl shadow-md border-4 border-white ring-2 ring-blue-50">
                        {{ substr($patient->name, 0, 1) }}
                    </div>
                    <div class="flex flex-col">
                        <h2 class="text-[28px] font-[900] text-[#0A3D74] leading-tight">{{ $patient->name }}</h2>
                        <p class="text-[14px] font-bold text-[#6A9DF6] mt-1 tracking-wide">{{ $patient->medical_record_number }}</p>
                    </div>
                </div>
                
                <div class="bg-[#F4F6FC] rounded-2xl px-6 py-4 border border-[#EBF4FF] text-center">
                    <span class="block text-[12px] font-[900] text-gray-400 uppercase tracking-widest mb-1">Total Kunjungan</span>
                    <span class="text-[32px] font-[900] text-[#0A3D74] leading-none">{{ $histories->count() }}<span class="text-[14px] text-[#6A9DF6] ml-1">kali</span></span>
                </div>
            </div>

            <div class="grid grid-cols-4 gap-6 mt-8 pt-6 border-t border-gray-100">
                <div class="flex flex-col">
                    <span class="text-[11px] font-[900] text-gray-400 uppercase tracking-wider mb-1">NIK</span>
                    <span class="text-[14px] font-bold text-gray-800">{{ $patient->nik }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-[900] text-gray-400 uppercase tracking-wider mb-1">Tanggal Lahir</span>
                    <span class="text-[14px] font-bold text-gray-800">{{ \Carbon\Carbon::parse($patient->birth_date)->format('d F Y') }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-[900] text-gray-400 uppercase tracking-wider mb-1">No. HP</span>
                    <span class="text-[14px] font-bold text-gray-800">{{ $patient->phone ?? '-' }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-[900] text-gray-400 uppercase tracking-wider mb-1">Alamat Lengkap</span>
                    <span class="text-[14px] font-bold text-gray-800 line-clamp-2">{{ $patient->address ?? '-' }}</span>
                </div>
            </div>
        </div>

        <!-- Riwayat Kunjungan -->
        <h3 class="text-[20px] font-[900] text-[#0A3D74] mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-[#6A9DF6]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Riwayat Penyakit & Penyembuhan
        </h3>

        <div class="flex flex-col gap-5">
            @forelse($histories as $history)
                <div class="bg-white rounded-[20px] shadow-[0_2px_15px_rgba(0,0,0,0.02)] border border-gray-100 p-6 transition-all hover:border-[#6A9DF6]/30">
                    <div class="flex justify-between items-center mb-5 pb-4 border-b border-gray-50">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-blue-50 text-[#6A9DF6] flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-[15px] font-[900] text-[#0A3D74]">{{ $history->created_at->format('l, d F Y') }}</h4>
                                <p class="text-[12px] font-bold text-gray-400 mt-0.5">{{ $history->created_at->format('H:i') }} WIB</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-green-50 text-green-600 rounded-full text-[11px] font-[900] tracking-widest uppercase">Selesai</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Kolom Penyakit -->
                        <div class="flex flex-col gap-4">
                            <div>
                                <h5 class="text-[12px] font-[900] text-gray-400 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Gejala / Keluhan
                                </h5>
                                <p class="text-[14px] font-bold text-gray-800 leading-relaxed">{{ $history->gejala ?? 'Tidak ada data keluhan.' }}</p>
                            </div>
                            <div>
                                <h5 class="text-[12px] font-[900] text-[#FF5B5B] uppercase tracking-wider mb-2 flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                    Diagnosa
                                </h5>
                                <p class="text-[14px] font-[900] text-gray-800 leading-relaxed bg-red-50/50 p-3 rounded-xl border border-red-100">{{ $history->diagnosa ?? 'Tidak ada diagnosa spesifik.' }}</p>
                            </div>
                        </div>

                        <!-- Kolom Penyembuhan -->
                        <div class="flex flex-col gap-4 border-l-2 border-dashed border-gray-100 pl-8">
                            <div>
                                <h5 class="text-[12px] font-[900] text-[#6A9DF6] uppercase tracking-wider mb-2 flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                                    Tindakan / Penyembuhan
                                </h5>
                                <p class="text-[14px] font-bold text-gray-800 leading-relaxed">{{ $history->tindakan ?? 'Tidak ada tindakan khusus.' }}</p>
                            </div>
                            
                            @if($history->prescription_data && count($history->prescription_data) > 0)
                            <div>
                                <h5 class="text-[12px] font-[900] text-[#56C427] uppercase tracking-wider mb-2 flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                                    Resep Obat
                                </h5>
                                <ul class="space-y-2">
                                    @foreach($history->prescription_data as $med)
                                        <li class="flex items-center justify-between bg-[#F4F6FC] p-2.5 rounded-lg border border-[#EBF4FF]">
                                            <span class="text-[13px] font-bold text-[#0A3D74]">{{ $med['name'] }}</span>
                                            <span class="text-[11px] font-[900] text-gray-500 bg-white px-2 py-1 rounded-md border border-gray-100">{{ $med['jumlah'] }} pcs</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-[20px] shadow-sm border border-gray-100 p-12 text-center">
                    <div class="w-16 h-16 bg-blue-50 text-[#6A9DF6] rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                    <h4 class="text-[16px] font-[900] text-[#0A3D74] mb-2">Belum Ada Riwayat Kunjungan</h4>
                    <p class="text-[13px] font-bold text-gray-500">Pasien ini belum memiliki rekam medis atau belum pernah menyelesaikan pembayaran kunjungan sebelumnya.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-clinic-layout>
