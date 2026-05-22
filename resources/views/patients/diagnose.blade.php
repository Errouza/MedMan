<x-doctor-layout>
    <!-- Back Button -->
    <a href="{{ route('patients.index') }}" class="inline-flex items-center gap-2 text-[13px] font-[900] text-gray-500 hover:text-[#0A3D74] mb-4 transition-colors">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Antrean
    </a>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 w-full">
        <!-- Kolom Kiri: Form Pemeriksaan Utama -->
        <div class="xl:col-span-8 flex flex-col gap-6">
            <!-- Form Pemeriksaan (Pasien Saat ini) -->
            <div class="bg-white rounded-[24px] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 p-8 w-full">
                <h3 class="text-[22px] font-[900] text-[#6A9DF6] mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Pasien Saat ini
                </h3>
                
                <div class="flex items-start gap-8 mb-8 bg-blue-50/50 p-5 rounded-2xl border border-blue-100/50">
                    <div class="flex flex-col">
                        <span class="text-[11px] font-extrabold text-black mb-1 uppercase tracking-wider">Antrian</span>
                        @php
                            $todayPatients = \App\Models\Patient::whereDate('created_at', \Carbon\Carbon::parse($patient->created_at)->toDateString())
                                                ->oldest()
                                                ->get();
                            $index = $todayPatients->search(function($p) use ($patient) { 
                                return $p->patient_id == $patient->patient_id; 
                            });
                            $queueNumber = $index + 1;
                        @endphp
                        <span class="text-[32px] font-[900] text-[#0A3D74] leading-none" style="font-family: 'Inter', sans-serif;">{{ $queueNumber }}</span>
                    </div>
                    <div class="w-px h-12 bg-blue-200 mx-2"></div>
                    <div class="flex flex-col">
                        <span class="text-[11px] font-extrabold text-black mb-1 uppercase tracking-wider">Rekam Medis</span>
                        <span class="text-[28px] font-[900] text-[#6A9DF6] leading-none tracking-tight">{{ $patient->medical_record_number }}</span>
                    </div>
                    <div class="grid grid-cols-2 gap-x-6 gap-y-3 pt-1 flex-1 pl-4 border-l border-blue-200">
                        <div class="flex flex-col">
                            <span class="text-[10px] font-extrabold text-gray-500 mb-0.5 uppercase tracking-wider">Nama Pasien</span>
                            <span class="text-[13px] font-bold text-[#0A3D74] truncate">{{ $patient->name }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[10px] font-extrabold text-gray-500 mb-0.5 uppercase tracking-wider">Tanggal Lahir</span>
                            <span class="text-[13px] font-bold text-[#0A3D74] truncate">{{ $patient->birth_date ?? '-' }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[10px] font-extrabold text-gray-500 mb-0.5 uppercase tracking-wider">NIK</span>
                            <span class="text-[13px] font-bold text-[#0A3D74] truncate">{{ $patient->nik }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[10px] font-extrabold text-gray-500 mb-0.5 uppercase tracking-wider">No. Hp</span>
                            <span class="text-[13px] font-bold text-[#0A3D74] truncate">{{ $patient->phone ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <form action="{{ route('patients.diagnose.update', $patient) }}" method="POST" x-data="{
                    butuhResep: false,
                    butuhAlat: false,
                    alatItems: [ { id: 1, obat: '', jumlah: '' } ],
                    items: [ { id: 1, obat: '', dosis: '', keterangan: '', jumlah: '' } ],
                    addAlat() { this.alatItems.push({ id: Date.now(), obat: '', jumlah: '' }); },
                    removeAlat(id) { if (this.alatItems.length > 1) this.alatItems = this.alatItems.filter(i => i.id !== id); },
                    addItem() { this.items.push({ id: Date.now(), obat: '', dosis: '', keterangan: '', jumlah: '' }); },
                    removeItem(id) { if (this.items.length > 1) this.items = this.items.filter(i => i.id !== id); }
                }">
                    @csrf
                    @method('PATCH')
                    
                    <div class="flex gap-6 mb-6">
                        <div class="flex-1 bg-[#6A9DF6] rounded-[16px] p-5 shadow-inner">
                            <label class="text-white font-[900] text-[16px] block mb-3 px-1">Keluhan / Gejala</label>
                            <input type="text" name="gejala" value="{{ old('gejala', $patient->gejala) }}" class="w-full rounded-[12px] border-none px-4 py-3 text-[14px] text-gray-800 font-bold focus:ring-4 focus:ring-white/30" required>
                        </div>
                        <div class="flex-1 bg-[#6A9DF6] rounded-[16px] p-5 shadow-inner">
                            <label class="text-white font-[900] text-[16px] block mb-3 px-1">Diagnosa Utama</label>
                            <input type="text" name="diagnosa" value="{{ old('diagnosa', $patient->diagnosa) }}" class="w-full rounded-[12px] border-none px-4 py-3 text-[14px] text-gray-800 font-bold focus:ring-4 focus:ring-white/30" required>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-[16px] p-5 w-full mb-6 border-[2.5px] border-gray-100">
                        <div class="flex gap-6">
                            <div class="flex-[2]">
                                <label class="text-[#0A3D74] font-[900] text-[15px] block mb-2 px-1">Tindakan Medis</label>
                                <input type="text" name="tindakan" value="{{ old('tindakan', $patient->tindakan) }}" placeholder="Isi Tindakan Dokter" class="w-full border-[2.5px] border-gray-200 rounded-[12px] px-4 py-3 text-[14px] text-gray-800 font-bold focus:ring-0 focus:border-[#6A9DF6] placeholder-gray-400 bg-white" required>
                            </div>
                            <div class="flex-1">
                                <label class="text-[#0A3D74] font-[900] text-[15px] block mb-2 px-1">Biaya Layanan (Rp)</label>
                                <input type="number" name="harga" value="{{ old('harga', $patient->harga ?? 100000) }}" class="w-full border-[2.5px] border-gray-200 rounded-[12px] px-4 py-3 text-[14px] text-gray-800 font-bold focus:ring-0 focus:border-[#6A9DF6] bg-white" required>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian Alat Medis Habis Pakai -->
                    <div class="border-[2.5px] border-gray-100 rounded-[16px] p-6 mb-6 transition-all duration-300" :class="butuhAlat ? 'bg-orange-50/50 border-orange-300/50' : 'bg-white'">
                        <label class="flex items-center gap-3 cursor-pointer w-fit" @click="butuhAlat = !butuhAlat">
                            <div class="w-6 h-6 rounded-md border-[2.5px] border-orange-400 flex items-center justify-center transition-colors" :class="butuhAlat ? 'bg-orange-400' : 'bg-white'">
                                <svg x-show="butuhAlat" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-[15px] font-[900] text-orange-600">Gunakan Alat Medis Habis Pakai (Otomatis +Biaya)</span>
                        </label>

                        <div x-show="butuhAlat" x-collapse class="mt-5">
                            <div class="flex flex-col gap-3">
                                <template x-for="(item, index) in alatItems" :key="item.id">
                                    <div class="flex items-end gap-4 relative group bg-white p-3.5 rounded-[12px] border border-gray-200 shadow-sm">
                                        <div class="flex-[3]">
                                            <label class="block text-[12px] font-[900] text-gray-500 mb-1.5 uppercase tracking-wider">Nama Alat Medis</label>
                                            <select x-model="item.obat" name="alat_medis[]" class="w-full border-[2px] border-gray-200 rounded-[8px] px-3 py-2 text-[13px] font-bold text-gray-700 focus:ring-0 focus:border-orange-400" :required="butuhAlat">
                                                <option value="" disabled selected>Pilih Alat...</option>
                                                @foreach(['medical_consumable' => 'Alat Medis Habis Pakai', 'medical_fluid' => 'Cairan Medis', 'medical_equipment' => 'Peralatan Medis'] as $cat => $label)
                                                    @if($medicines->where('category', $cat)->count() > 0)
                                                        <optgroup label="{{ $label }}">
                                                            @foreach($medicines->where('category', $cat) as $med)
                                                                <option value="{{ $med->id }}">{{ $med->name }} (Stok: {{ $med->stock }})</option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="w-[100px]">
                                            <label class="block text-[12px] font-[900] text-gray-500 mb-1.5 uppercase tracking-wider">Jumlah</label>
                                            <input type="number" x-model="item.jumlah" name="alat_jumlah[]" class="w-full border-[2px] border-gray-200 rounded-[8px] px-3 py-2 text-[13px] font-bold text-gray-700 focus:ring-0 focus:border-orange-400" :required="butuhAlat" min="1" placeholder="Qty">
                                        </div>
                                        <!-- Action Remove -->
                                        <div class="absolute -right-3 -top-3 opacity-0 group-hover:opacity-100 transition-opacity" x-show="alatItems.length > 1">
                                            <button type="button" @click="removeAlat(item.id)" class="bg-red-100 text-red-500 rounded-full p-1.5 shadow-sm hover:bg-red-500 hover:text-white transition-colors">
                                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                </template>
                            </div>
                            <div class="mt-3">
                                <button type="button" @click="addAlat()" class="bg-orange-50 text-orange-600 hover:bg-orange-500 hover:text-white text-[11px] font-[900] uppercase tracking-wider px-4 py-2 rounded-[8px] transition-colors shadow-sm flex items-center gap-1.5">
                                    <span class="text-lg leading-none">+</span> Tambah Alat
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian Resep Obat Terintegrasi -->
                    <div class="border-[2.5px] border-gray-100 rounded-[16px] p-6 mb-6 transition-all duration-300" :class="butuhResep ? 'bg-green-50/50 border-green-300/50' : 'bg-white'">
                        <label class="flex items-center gap-3 cursor-pointer w-fit" @click="butuhResep = !butuhResep">
                            <div class="w-6 h-6 rounded-md border-[2.5px] border-[#56C427] flex items-center justify-center transition-colors" :class="butuhResep ? 'bg-[#56C427]' : 'bg-white'">
                                <svg x-show="butuhResep" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-[15px] font-[900] text-[#56C427]">Berikan Resep Obat untuk Pasien</span>
                        </label>

                        <div x-show="butuhResep" x-collapse class="mt-5">
                            <div class="flex flex-col gap-3">
                                <template x-for="(item, index) in items" :key="item.id">
                                    <div class="flex items-end gap-3 relative group bg-white p-3.5 rounded-[12px] border border-gray-200 shadow-sm">
                                        <!-- Nama Obat -->
                                        <div class="flex-[1.5]">
                                            <label class="block text-[11px] font-[900] text-gray-500 mb-1.5 uppercase tracking-wider">Nama Obat</label>
                                            <select x-model="item.obat" name="resep_obat[]" class="w-full border-[2px] border-gray-200 rounded-[8px] px-3 py-2 text-[13px] font-bold text-gray-700 focus:ring-0 focus:border-[#56C427]" :required="butuhResep">
                                                <option value="" disabled selected>Pilih Obat...</option>
                                                @foreach($medicines->where('category', 'medicines') as $med)
                                                    <option value="{{ $med->id }}">{{ $med->name }} (Stok: {{ $med->stock }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- Dosis Obat -->
                                        <div class="flex-1">
                                            <label class="block text-[11px] font-[900] text-gray-500 mb-1.5 uppercase tracking-wider">Dosis</label>
                                            <select x-model="item.dosis" name="resep_dosis[]" class="w-full border-[2px] border-gray-200 rounded-[8px] px-3 py-2 text-[13px] font-bold text-gray-700 focus:ring-0 focus:border-[#56C427]" :required="butuhResep">
                                                <option value="" disabled selected>Dosis...</option>
                                                <option value="3 x 1 Hari">3 x 1 Hari</option>
                                                <option value="2 x 1 Hari">2 x 1 Hari</option>
                                                <option value="1 x 1 Hari">1 x 1 Hari</option>
                                                <option value="Sesuai Kebutuhan">Sesuai Kebutuhan</option>
                                            </select>
                                        </div>
                                        <!-- Keterangan -->
                                        <div class="flex-[1.5]">
                                            <label class="block text-[11px] font-[900] text-gray-500 mb-1.5 uppercase tracking-wider">Keterangan</label>
                                            <input type="text" x-model="item.keterangan" name="resep_keterangan[]" class="w-full border-[2px] border-gray-200 rounded-[8px] px-3 py-2 text-[13px] font-bold text-gray-700 focus:ring-0 focus:border-[#56C427]" placeholder="Contoh: Sesudah makan">
                                        </div>
                                        <!-- Jumlah -->
                                        <div class="w-[70px]">
                                            <label class="block text-[11px] font-[900] text-gray-500 mb-1.5 uppercase tracking-wider">Qty</label>
                                            <input type="number" x-model="item.jumlah" name="resep_jumlah[]" class="w-full border-[2px] border-gray-200 rounded-[8px] px-3 py-2 text-[13px] font-bold text-gray-700 focus:ring-0 focus:border-[#56C427]" :required="butuhResep" min="1" placeholder="Qty">
                                        </div>
                                        
                                        <!-- Action Remove -->
                                        <div class="absolute -right-3 -top-3 opacity-0 group-hover:opacity-100 transition-opacity" x-show="items.length > 1">
                                            <button type="button" @click="removeItem(item.id)" class="bg-red-100 text-red-500 rounded-full p-1.5 shadow-sm hover:bg-red-500 hover:text-white transition-colors">
                                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                </template>
                            </div>
                            
                            <div class="mt-3">
                                <button type="button" @click="addItem()" class="bg-green-50 text-green-600 hover:bg-[#56C427] hover:text-white text-[11px] font-[900] uppercase tracking-wider px-4 py-2 rounded-[8px] transition-colors shadow-sm flex items-center gap-1.5">
                                    <span class="text-lg leading-none">+</span> Tambah Resep
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-5 border-t border-gray-100">
                        <button type="submit" class="bg-[#6A9DF6] hover:bg-[#5b8ce0] text-white font-[900] text-[15px] px-12 py-3.5 rounded-full transition-colors shadow-lg flex items-center gap-2">
                            Simpan & Selesai Pemeriksaan
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Kolom Kanan: Riwayat Medis -->
        <div class="xl:col-span-4 flex flex-col gap-6">
            <div class="bg-white rounded-[24px] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 p-6 w-full h-full flex flex-col">
                <h3 class="text-[16px] font-[900] text-[#0A3D74] mb-5 flex items-center gap-2 border-b border-gray-100 pb-4">
                    <svg class="w-5 h-5 text-[#6A9DF6]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Riwayat Medis Pasien
                </h3>
                
                <div class="flex-1 overflow-y-auto pr-2 custom-scrollbar space-y-4 max-h-[700px]">
                    @forelse($histories as $history)
                        <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100 relative group transition-colors hover:bg-blue-50/50 hover:border-blue-100">
                            <div class="absolute -left-1.5 top-5 w-3 h-3 bg-[#6A9DF6] rounded-full border-2 border-white shadow-sm"></div>
                            <div class="pl-3">
                                <span class="text-[11px] font-black text-gray-400 uppercase tracking-widest block mb-1">{{ $history->created_at->format('d M Y') }}</span>
                                <h4 class="text-[13px] font-[900] text-[#0A3D74] leading-tight mb-2">Diagnosa: {{ $history->diagnosa ?? '-' }}</h4>
                                
                                <div class="text-[12px] font-bold text-gray-600 space-y-1">
                                    <p><span class="text-gray-400">Keluhan:</span> {{ $history->gejala ?? '-' }}</p>
                                    <p><span class="text-gray-400">Tindakan:</span> {{ $history->tindakan ?? '-' }}</p>
                                </div>
                                
                                @if($history->prescription_data && count($history->prescription_data) > 0)
                                    <div class="mt-3 pt-3 border-t border-gray-200/60">
                                        <p class="text-[11px] font-black text-green-600 mb-1.5">Resep / Obat:</p>
                                        <ul class="list-disc list-inside text-[11px] font-bold text-gray-500 marker:text-green-300">
                                            @foreach($history->prescription_data as $med)
                                                <li>{{ $med['name'] }} ({{ $med['jumlah'] }})</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center h-40 text-center px-4">
                            <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-300 mb-3">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            </div>
                            <p class="text-[12px] font-bold text-gray-400">Belum ada riwayat pemeriksaan sebelumnya.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-doctor-layout>
