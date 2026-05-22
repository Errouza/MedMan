<x-clinic-layout>
    <div class="flex flex-col gap-6 w-full max-w-7xl mx-auto" x-data="{
        showModal: false,
        modalMode: 'add', // 'add' or 'edit'
        form: {
            id: null,
            name: '',
            category: 'medicines',
            price: '',
            stock: ''
        },
        openAddModal() {
            this.modalMode = 'add';
            this.form.id = null;
            this.form.name = '';
            this.form.category = 'medicines';
            this.form.price = '';
            this.form.stock = '';
            this.showModal = true;
        },
        openEditModal(item) {
            this.modalMode = 'edit';
            this.form.id = item.id;
            this.form.name = item.name;
            this.form.category = item.category || 'medicines';
            this.form.price = item.price;
            this.form.stock = item.stock;
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
        }
    }">
        
        @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-xl shadow-sm mb-2" role="alert">
            <p class="font-bold text-[14px]">Berhasil</p>
            <p class="text-[13px]">{{ session('success') }}</p>
        </div>
        @endif

        <!-- Header Section -->
        <div class="flex items-center justify-between bg-white rounded-[24px] shadow-[0_0_15px_rgba(0,0,0,0.02)] border border-gray-100 p-8 w-full">
            <div>
                <h2 class="text-[22px] font-[900] text-gray-900 mb-1">Daftar Stok & Layanan Medis</h2>
                <p class="text-[13px] text-gray-500 font-medium">Kelola seluruh daftar biaya tindakan dan stok barang dalam klinik Anda.</p>
            </div>
            <button @click="openAddModal()" class="flex items-center gap-2 bg-[#6A9DF6] hover:bg-blue-600 text-white px-6 py-3 rounded-full font-bold text-[14px] transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                Tambah Item
            </button>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-[24px] shadow-[0_0_15px_rgba(0,0,0,0.02)] border border-gray-100 p-8 w-full">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-gray-100">
                            <th class="py-4 px-4 text-[#0A3D74] font-[900] text-[13px] uppercase tracking-wider w-16 text-center">No</th>
                            <th class="py-4 px-4 text-[#0A3D74] font-[900] text-[13px] uppercase tracking-wider">Nama Tindakan/Item</th>
                            <th class="py-4 px-4 text-[#0A3D74] font-[900] text-[13px] uppercase tracking-wider">Kategori</th>
                            <th class="py-4 px-4 text-[#0A3D74] font-[900] text-[13px] uppercase tracking-wider text-center">Stok</th>
                            <th class="py-4 px-4 text-[#0A3D74] font-[900] text-[13px] uppercase tracking-wider text-right">Tarif (Rp)</th>
                            <th class="py-4 px-4 text-[#0A3D74] font-[900] text-[13px] uppercase tracking-wider text-center w-48">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($medicines as $index => $item)
                        <tr class="hover:bg-gray-50 transition-colors group">
                            <td class="py-4 px-4 text-center font-bold text-gray-400 text-[13px]">{{ $index + 1 }}</td>
                            <td class="py-4 px-4 font-bold text-gray-800 text-[14px]">{{ $item->name }}</td>
                            <td class="py-4 px-4">
                                @if($item->category == 'medicines')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800">Obat / Resep</span>
                                @elseif($item->category == 'medical_consumable')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-orange-100 text-orange-800">Alat Habis Pakai</span>
                                @elseif($item->category == 'medical_fluid')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-cyan-100 text-cyan-800">Cairan Medis</span>
                                @elseif($item->category == 'medical_equipment')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-800">Peralatan Medis</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-800">Lainnya</span>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-center font-bold text-gray-800 text-[14px]">
                                <span class="px-3 py-1 rounded-full text-xs {{ $item->stock <= 10 ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                                    {{ $item->stock }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-right font-[900] text-[#6A9DF6] text-[15px]">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="py-4 px-4 text-center">
                                <div class="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button @click="openEditModal({{ json_encode($item) }})" class="flex items-center gap-1.5 bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white px-3 py-1.5 rounded-lg text-[11px] font-bold transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        Edit
                                    </button>
                                    <form action="{{ route('stock.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center gap-1.5 bg-red-50 text-red-600 hover:bg-red-500 hover:text-white px-3 py-1.5 rounded-lg text-[11px] font-bold transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-gray-500 font-medium">Belum ada data stok.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                
                <div x-show="showModal" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0" 
                     x-transition:enter-end="opacity-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100" 
                     x-transition:leave-end="opacity-0" 
                     class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity backdrop-blur-sm" 
                     aria-hidden="true" @click="closeModal()"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="showModal" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="inline-block align-bottom bg-white rounded-[24px] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-gray-100">
                    
                    <form :action="modalMode === 'add' ? '{{ route('stock.store') }}' : `/stock/${form.id}`" method="POST">
                        @csrf
                        <template x-if="modalMode === 'edit'">
                            <input type="hidden" name="_method" value="PUT">
                        </template>

                        <div class="bg-white px-8 pt-8 pb-6">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                    <h3 class="text-[20px] leading-6 font-[900] text-[#0A3D74] mb-6" id="modal-title" x-text="modalMode === 'add' ? 'Tambah Item Baru' : 'Edit Item'"></h3>
                                    <div class="space-y-5">
                                        <div>
                                            <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Nama Item / Tindakan</label>
                                            <input type="text" name="name" x-model="form.name" required class="block w-full border border-gray-200 rounded-xl px-4 py-3 text-[14px] focus:ring-2 focus:ring-[#6A9DF6] focus:border-[#6A9DF6] outline-none transition-all placeholder-gray-400" placeholder="Contoh: Paracetamol 500mg">
                                        </div>
                                        <div>
                                            <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Kategori</label>
                                            <select name="category" x-model="form.category" required class="block w-full border border-gray-200 rounded-xl px-4 py-3 text-[14px] focus:ring-2 focus:ring-[#6A9DF6] focus:border-[#6A9DF6] outline-none transition-all">
                                                <option value="medicines">Obat / Resep</option>
                                                <option value="medical_consumable">Alat Medis Habis Pakai</option>
                                                <option value="medical_fluid">Cairan Medis</option>
                                                <option value="medical_equipment">Peralatan Medis</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Stok Saat Ini</label>
                                            <input type="number" name="stock" x-model="form.stock" required min="0" class="block w-full border border-gray-200 rounded-xl px-4 py-3 text-[14px] focus:ring-2 focus:ring-[#6A9DF6] focus:border-[#6A9DF6] outline-none transition-all" placeholder="0">
                                        </div>
                                        <div>
                                            <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Tarif / Harga (Rp)</label>
                                            <input type="number" name="price" x-model="form.price" required min="0" class="block w-full border border-gray-200 rounded-xl px-4 py-3 text-[14px] focus:ring-2 focus:ring-[#6A9DF6] focus:border-[#6A9DF6] outline-none transition-all" placeholder="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-8 py-5 flex flex-row-reverse gap-3 rounded-b-[24px]">
                            <button type="submit" class="inline-flex justify-center rounded-xl border border-transparent px-6 py-2.5 bg-[#6A9DF6] text-[14px] font-bold text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#6A9DF6] transition-colors shadow-sm">
                                Simpan
                            </button>
                            <button type="button" @click="closeModal()" class="inline-flex justify-center rounded-xl border border-gray-200 px-6 py-2.5 bg-white text-[14px] font-bold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-colors">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-clinic-layout>
