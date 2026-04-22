<x-clinic-layout>
    <div class="flex flex-col gap-6 w-full max-w-7xl mx-auto">
        
        <!-- Header Section -->
        <div class="flex items-center justify-between bg-white rounded-[24px] shadow-[0_0_15px_rgba(0,0,0,0.02)] border border-gray-100 p-8 w-full">
            <div>
                <h2 class="text-[22px] font-[900] text-gray-900 mb-1">Daftar Stok & Layanan Medis</h2>
                <p class="text-[13px] text-gray-500 font-medium">Kelola seluruh daftar biaya tindakan dan stok barang dalam klinik Anda.</p>
            </div>
            <button class="flex items-center gap-2 bg-[#6A9DF6] hover:bg-blue-600 text-white px-6 py-3 rounded-full font-bold text-[14px] transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                Tambah Item
            </button>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-[24px] shadow-[0_0_15px_rgba(0,0,0,0.02)] border border-gray-100 p-8 w-full">
            @php
                $items = [
                    ['name' => 'Konsultasi Dokter Umum', 'price' => 75000],
                    ['name' => 'Konsultasi + Resep', 'price' => 100000],
                    ['name' => 'Injeksi (suntik)', 'price' => 30000],
                    ['name' => 'Infus', 'price' => 200000],
                    ['name' => 'Nebulizer', 'price' => 75000],
                    ['name' => 'Pemasangan Kateter', 'price' => 150000],
                    ['name' => 'Perawatan Luka Ringan', 'price' => 75000],
                    ['name' => 'Perawatan Luka Sedang', 'price' => 150000],
                    ['name' => 'Jahit Luka (hecting)', 'price' => 300000],
                    ['name' => 'Buka Jahitan', 'price' => 75000],
                    ['name' => 'Suntik Tetanus', 'price' => 150000],
                    ['name' => 'Tindik Telinga Medis', 'price' => 100000],
                    ['name' => 'Khitan (Sunat)', 'price' => 1000000],
                    ['name' => 'Cek Gula Darah', 'price' => 30000],
                    ['name' => 'Cek Kolesterol', 'price' => 75000],
                    ['name' => 'Cek Asam Urat', 'price' => 50000],
                    ['name' => 'Tes Kehamilan', 'price' => 30000],
                    ['name' => 'Surat Sakit', 'price' => 30000],
                    ['name' => 'Surat Sehat', 'price' => 50000],
                ];
            @endphp
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-gray-100">
                            <th class="py-4 px-4 text-[#0A3D74] font-[900] text-[13px] uppercase tracking-wider w-16 text-center">No</th>
                            <th class="py-4 px-4 text-[#0A3D74] font-[900] text-[13px] uppercase tracking-wider">Nama Tindakan/Item</th>
                            <th class="py-4 px-4 text-[#0A3D74] font-[900] text-[13px] uppercase tracking-wider text-right">Tarif (Rp)</th>
                            <th class="py-4 px-4 text-[#0A3D74] font-[900] text-[13px] uppercase tracking-wider text-center w-48">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($items as $index => $item)
                        <tr class="hover:bg-gray-50 transition-colors group">
                            <td class="py-4 px-4 text-center font-bold text-gray-400 text-[13px]">{{ $index + 1 }}</td>
                            <td class="py-4 px-4 font-bold text-gray-800 text-[14px]">{{ $item['name'] }}</td>
                            <td class="py-4 px-4 text-right font-[900] text-[#6A9DF6] text-[15px]">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td class="py-4 px-4 text-center">
                                <!-- Visible only when hovered (or always visible depending on preference, but hover makes it clean) -->
                                <div class="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button class="flex items-center gap-1.5 bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white px-3 py-1.5 rounded-lg text-[11px] font-bold transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        Edit
                                    </button>
                                    <button class="flex items-center gap-1.5 bg-red-50 text-red-600 hover:bg-red-500 hover:text-white px-3 py-1.5 rounded-lg text-[11px] font-bold transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-clinic-layout>
