<x-doctor-layout>
    <!-- Back Button -->
    <a href="{{ route('patients.index') }}" class="inline-flex items-center gap-2 text-[13px] font-[900] text-gray-500 hover:text-[#0A3D74] mb-4 transition-colors">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Antrean
    </a>

    <!-- Form Pemeriksaan (Pasien Saat ini) -->
    <div class="bg-white rounded-[24px] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 p-8 w-full">
        <h3 class="text-[22px] font-[900] text-[#6A9DF6] mb-6">Pasien Saat ini</h3>
        
        <div class="flex items-start gap-12 mb-8">
            <div class="flex flex-col">
                <span class="text-[12px] font-extrabold text-black mb-1">No. Urut Antrian</span>
                <span class="text-[36px] font-[900] text-[#6A9DF6] leading-none" style="font-family: 'Inter', sans-serif;">{{ \App\Models\Patient::whereDate('created_at', \Carbon\Carbon::today())->count() + 1024 }}</span>
            </div>
            <div class="flex flex-col">
                <span class="text-[12px] font-extrabold text-black mb-1">No.Rekam Medis</span>
                <span class="text-[36px] font-[900] text-[#6A9DF6] leading-none" style="font-family: 'Inter', sans-serif;">{{ $patient->medical_record_number }}</span>
            </div>
            <div class="grid grid-cols-3 gap-x-8 gap-y-4 pt-1 flex-1">
                <div class="flex flex-col">
                    <span class="text-[11px] font-extrabold text-black mb-0.5">Nama Pasien</span>
                    <span class="text-[13px] font-bold text-[#6A9DF6]">{{ $patient->name }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-extrabold text-black mb-0.5">Tanggal Lahir</span>
                    <span class="text-[13px] font-bold text-[#6A9DF6]">{{ $patient->birth_date ?? '-' }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-extrabold text-black mb-0.5">Alamat</span>
                    <span class="text-[13px] font-bold text-[#6A9DF6]">{{ $patient->address ?? '-' }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-extrabold text-black mb-0.5">NIK</span>
                    <span class="text-[13px] font-bold text-[#6A9DF6]">{{ $patient->nik }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-extrabold text-black mb-0.5">No. Hp</span>
                    <span class="text-[13px] font-bold text-[#6A9DF6]">{{ $patient->phone ?? '-' }}</span>
                </div>
            </div>
        </div>

        <form action="{{ route('patients.diagnose.update', $patient) }}" method="POST" x-data="{
            butuhResep: false,
            items: [
                { id: 1, obat: '', dosis: '', keterangan: '', jumlah: '' }
            ],
            addItem() {
                this.items.push({ id: Date.now(), obat: '', dosis: '', keterangan: '', jumlah: '' });
            },
            removeItem(id) {
                if (this.items.length > 1) {
                    this.items = this.items.filter(i => i.id !== id);
                }
            }
        }">
            @csrf
            @method('PATCH')
            
            <div class="flex gap-6 mb-6">
                <div class="flex-1 bg-[#6A9DF6] rounded-[16px] p-5">
                    <label class="text-white font-[900] text-[18px] block mb-3 px-1">Keluhan</label>
                    <input type="text" name="gejala" value="{{ old('gejala', $patient->gejala) }}" class="w-full rounded-[12px] border-none px-4 py-3 text-[14px] text-gray-800 font-bold focus:ring-4 focus:ring-white/30" required>
                </div>
                <div class="flex-1 bg-[#6A9DF6] rounded-[16px] p-5">
                    <label class="text-white font-[900] text-[18px] block mb-3 px-1">Diagnosa</label>
                    <input type="text" name="diagnosa" value="{{ old('diagnosa', $patient->diagnosa) }}" class="w-full rounded-[12px] border-none px-4 py-3 text-[14px] text-gray-800 font-bold focus:ring-4 focus:ring-white/30" required>
                </div>
            </div>

            <div class="bg-[#6A9DF6] rounded-[16px] p-5 w-full mb-6">
                <div class="flex gap-6">
                    <div class="flex-[2]">
                        <label class="text-white font-[900] text-[18px] block mb-3 px-1">Tindakan</label>
                        <input type="text" name="tindakan" value="{{ old('tindakan', $patient->tindakan) }}" placeholder="Isi Tindakan Dokter" class="w-full rounded-[12px] border-none px-4 py-3 text-[14px] text-gray-800 font-bold focus:ring-4 focus:ring-white/30 placeholder-gray-400" required>
                    </div>
                    <div class="flex-1">
                        <label class="text-white font-[900] text-[18px] block mb-3 px-1">Biaya Layanan Dokter</label>
                        <input type="number" name="harga" value="{{ old('harga', $patient->harga) }}" placeholder="Contoh: 50000" class="w-full rounded-[12px] border-none px-4 py-3 text-[14px] text-gray-800 font-bold focus:ring-4 focus:ring-white/30 placeholder-gray-400" required>
                    </div>
                </div>
            </div>

            <!-- Bagian Resep Obat Terintegrasi -->
            <div class="border-[2.5px] border-gray-100 rounded-[16px] p-6 mb-6 transition-all duration-300" :class="butuhResep ? 'bg-blue-50/30 border-[#6A9DF6]/30' : 'bg-white'">
                <label class="flex items-center gap-3 cursor-pointer w-fit" @click="butuhResep = !butuhResep">
                    <div class="w-6 h-6 rounded-md border-[2.5px] border-[#6A9DF6] flex items-center justify-center transition-colors" :class="butuhResep ? 'bg-[#6A9DF6]' : 'bg-white'">
                        <svg x-show="butuhResep" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="text-[16px] font-[900] text-[#0A3D74]">Berikan Resep Obat untuk Pasien</span>
                </label>

                <div x-show="butuhResep" x-collapse class="mt-6">
                    <div class="flex flex-col gap-4">
                        <template x-for="(item, index) in items" :key="item.id">
                            <div class="flex items-end gap-4 relative group bg-white p-4 rounded-[12px] border border-gray-200 shadow-sm">
                                <!-- Nama Obat -->
                                <div class="flex-[1.5]">
                                    <label class="block text-[13px] font-[900] text-gray-600 mb-1.5">Nama Obat</label>
                                    <select x-model="item.obat" name="resep_obat[]" class="w-full border-[2px] border-gray-200 rounded-[8px] px-3 py-2 text-[13px] font-bold text-gray-700 focus:ring-0 focus:border-[#6A9DF6]" :required="butuhResep">
                                        <option value="" disabled selected>Pilih Obat...</option>
                                        <option value="Paracetamol 500mg">Paracetamol 500mg</option>
                                        <option value="Amoxicillin 500mg">Amoxicillin 500mg</option>
                                        <option value="Omeprazole 20mg">Omeprazole 20mg</option>
                                        <option value="Ibuprofen 400mg">Ibuprofen 400mg</option>
                                        <option value="Vitamin C 500mg">Vitamin C 500mg</option>
                                    </select>
                                </div>
                                <!-- Dosis Obat -->
                                <div class="flex-1">
                                    <label class="block text-[13px] font-[900] text-gray-600 mb-1.5">Dosis Obat</label>
                                    <select x-model="item.dosis" name="resep_dosis[]" class="w-full border-[2px] border-gray-200 rounded-[8px] px-3 py-2 text-[13px] font-bold text-gray-700 focus:ring-0 focus:border-[#6A9DF6]" :required="butuhResep">
                                        <option value="" disabled selected>Pilih Dosis...</option>
                                        <option value="3 x 1 Hari">3 x 1 Hari</option>
                                        <option value="2 x 1 Hari">2 x 1 Hari</option>
                                        <option value="1 x 1 Hari">1 x 1 Hari</option>
                                        <option value="Sesuai Kebutuhan">Sesuai Kebutuhan</option>
                                    </select>
                                </div>
                                <!-- Keterangan -->
                                <div class="flex-[1.5]">
                                    <label class="block text-[13px] font-[900] text-gray-600 mb-1.5">Keterangan</label>
                                    <input type="text" x-model="item.keterangan" name="resep_keterangan[]" class="w-full border-[2px] border-gray-200 rounded-[8px] px-3 py-2 text-[13px] font-bold text-gray-700 focus:ring-0 focus:border-[#6A9DF6]" placeholder="Contoh: Sesudah makan">
                                </div>
                                <!-- Jumlah -->
                                <div class="w-[90px]">
                                    <label class="block text-[13px] font-[900] text-gray-600 mb-1.5">Jumlah</label>
                                    <input type="number" x-model="item.jumlah" name="resep_jumlah[]" class="w-full border-[2px] border-gray-200 rounded-[8px] px-3 py-2 text-[13px] font-bold text-gray-700 focus:ring-0 focus:border-[#6A9DF6]" :required="butuhResep" min="1" placeholder="Qty">
                                </div>
                                
                                <!-- Action Remove -->
                                <div class="absolute -right-3 -top-3 opacity-0 group-hover:opacity-100 transition-opacity" x-show="items.length > 1">
                                    <button type="button" @click="removeItem(item.id)" class="bg-red-100 text-red-500 rounded-full p-1.5 shadow-sm hover:bg-red-500 hover:text-white transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                    
                    <div class="mt-4">
                        <button type="button" @click="addItem()" class="bg-[#EBF4FF] text-[#0A3D74] hover:bg-[#6A9DF6] hover:text-white text-[12px] font-[900] px-4 py-2 rounded-[8px] transition-colors shadow-sm flex items-center gap-2">
                            <span class="text-lg leading-none">+</span> Tambah Baris Obat
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-100">
                <button type="submit" class="bg-[#6A9DF6] hover:bg-[#5b8ce0] text-white font-[900] text-[15px] px-12 py-3.5 rounded-full transition-colors shadow-lg flex items-center gap-2">
                    Simpan & Selesai
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                </button>
            </div>
        </form>
    </div>
</x-doctor-layout>
