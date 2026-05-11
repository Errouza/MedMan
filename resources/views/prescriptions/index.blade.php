<x-doctor-layout>
    <div class="w-full">
        <h2 class="text-[28px] font-[900] text-[#6A9DF6] mb-8">Buat Resep</h2>

        @if(session('success'))
        <div class="mb-8 p-4 bg-green-50 border-l-4 border-[#56C427] rounded-r-lg shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-[#56C427] rounded-full flex items-center justify-center text-white"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg></div>
                <span class="text-green-800 font-bold text-[14px]">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        <form action="#" method="POST" x-data="{
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
            
            <!-- Nama Pasien (Bottom Border Only) -->
            <div class="mb-8 max-w-lg">
                <label class="block text-[16px] font-[900] text-black mb-1">Nama Pasien</label>
                <select name="patient_id" class="w-full border-0 border-b-[3px] border-[#6A9DF6] px-0 py-2 text-[15px] font-bold text-gray-800 bg-transparent focus:ring-0 focus:border-[#4B82F6]" required>
                    <option value="" disabled selected>Pilih Pasien...</option>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->name }} (RM: {{ $patient->medical_record_number }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal -->
            <div class="mb-8">
                <label class="block text-[15px] font-[900] text-black mb-2">Tanggal</label>
                <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="w-[200px] border-[2.5px] border-[#6A9DF6] rounded-[10px] px-4 py-2 text-[14px] font-bold text-gray-700 focus:ring-0 focus:border-[#4B82F6]" required>
            </div>

            <!-- Dynamic Medicine Rows -->
            <div class="mb-8 flex flex-col gap-4">
                <template x-for="(item, index) in items" :key="item.id">
                    <div class="flex items-end gap-6 relative group">
                        
                        <!-- Nama Obat -->
                        <div class="flex-[1.5]">
                            <label x-show="index === 0" class="block text-[15px] font-[900] text-black mb-2">Nama Obat</label>
                            <select x-model="item.obat" name="obat[]" class="w-full border-[2.5px] border-[#6A9DF6] rounded-[10px] px-4 py-2 text-[14px] font-bold text-gray-700 focus:ring-0 focus:border-[#4B82F6] appearance-none bg-white bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%236A9DF6%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E')] bg-[length:12px_12px] bg-no-repeat bg-[position:right_1rem_center]" required>
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
                            <label x-show="index === 0" class="block text-[15px] font-[900] text-black mb-2">Dosis Obat</label>
                            <select x-model="item.dosis" name="dosis[]" class="w-full border-[2.5px] border-[#6A9DF6] rounded-[10px] px-4 py-2 text-[14px] font-bold text-gray-700 focus:ring-0 focus:border-[#4B82F6] appearance-none bg-white bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%236A9DF6%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E')] bg-[length:12px_12px] bg-no-repeat bg-[position:right_1rem_center]" required>
                                <option value="" disabled selected>Pilih Dosis...</option>
                                <option value="3 x 1 Hari">3 x 1 Hari</option>
                                <option value="2 x 1 Hari">2 x 1 Hari</option>
                                <option value="1 x 1 Hari">1 x 1 Hari</option>
                                <option value="Sesuai Kebutuhan">Sesuai Kebutuhan</option>
                            </select>
                        </div>

                        <!-- Keterangan -->
                        <div class="flex-[1.5]">
                            <label x-show="index === 0" class="block text-[15px] font-[900] text-black mb-2">Keterangan</label>
                            <input type="text" x-model="item.keterangan" name="keterangan[]" class="w-full border-[2.5px] border-[#6A9DF6] rounded-[10px] px-4 py-2 text-[14px] font-bold text-gray-700 focus:ring-0 focus:border-[#4B82F6]" placeholder="Contoh: Sesudah makan">
                        </div>

                        <!-- Jumlah -->
                        <div class="w-[120px]">
                            <label x-show="index === 0" class="block text-[15px] font-[900] text-black mb-2">Jumlah</label>
                            <select x-model="item.jumlah" name="jumlah[]" class="w-full border-[2.5px] border-[#6A9DF6] rounded-[10px] px-4 py-2 text-[14px] font-bold text-gray-700 focus:ring-0 focus:border-[#4B82F6] appearance-none bg-white bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%236A9DF6%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E')] bg-[length:12px_12px] bg-no-repeat bg-[position:right_1rem_center]" required>
                                <option value="" disabled selected>Pilih...</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                            </select>
                        </div>
                        
                        <!-- Action Remove (visible on hover or if items > 1) -->
                        <div class="absolute -right-8 top-1/2 translate-y-2 opacity-0 group-hover:opacity-100 transition-opacity" x-show="items.length > 1">
                            <button type="button" @click="removeItem(item.id)" class="text-red-400 hover:text-red-600 p-1">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </div>
                </template>
            </div>
            
            <!-- Tambah Obat Button -->
            <button type="button" @click="addItem()" class="text-[#6A9DF6] text-[13px] font-[900] mb-12 hover:text-[#4B82F6] flex items-center gap-2">
                <span class="w-5 h-5 bg-[#EBF4FF] rounded-full flex items-center justify-center">+</span> Tambah Obat Lain
            </button>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between border-t border-gray-100 pt-8 mt-4">
                <button type="submit" class="bg-[#56C427] hover:bg-[#4CAF21] text-white font-[900] text-[14px] px-8 py-2.5 rounded-[12px] transition-colors shadow-sm tracking-wide">
                    Tanda Tangani
                </button>
                <button type="button" class="bg-[#6A9DF6] hover:bg-[#4B82F6] text-white font-[900] text-[14px] px-8 py-2.5 rounded-[12px] transition-colors shadow-sm tracking-wide flex items-center gap-2">
                    Print
                </button>
            </div>

        </form>
    </div>
</x-doctor-layout>
