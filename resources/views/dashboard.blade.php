<x-clinic-layout>
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 w-full max-w-7xl">
        
        <!-- Kiri: Jumlah Pasien & Antrian -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 flex p-8 items-center justify-around drop-shadow-sm min-h-[160px]">
            <div class="text-center">
                <h3 class="text-sm font-bold text-black mb-2">Jumlah Pasien Hari ini</h3>
                <div class="text-[56px] leading-none font-extrabold text-[#6A9DF6]">2034</div>
            </div>
            
            <div class="w-px h-24 bg-gray-100 mx-4"></div> <!-- Divider -->
            
            <div class="text-center">
                <h3 class="text-sm font-bold text-black mb-2">No. Urut Antrian</h3>
                <div class="text-[56px] leading-none font-extrabold text-[#6A9DF6]">1024</div>
            </div>
        </div>

        <!-- Kanan: Tanggal & Tabel List -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 flex p-8 items-start gap-8 drop-shadow-sm min-h-[160px]">
            
            <!-- Date Widget -->
            <div class="flex flex-col items-center">
                <div class="w-16 flex flex-col overflow-hidden rounded-t-md shadow-sm border border-[#6A9DF6]">
                    <div class="bg-[#6A9DF6] text-white text-[10px] uppercase font-bold text-center py-1">wed</div>
                    <div class="bg-[#6A9DF6] text-white text-3xl font-extrabold text-center pb-2 leading-none">2</div>
                </div>
                <div class="text-[10px] font-bold text-black mt-2">Maret 2026</div>
            </div>

            <!-- Table -->
            <div class="flex-1">
                <table class="w-full border-collapse border border-gray-800 text-sm font-medium">
                    <tbody>
                        <tr>
                            <td class="border border-gray-800 bg-[#6A9DF6] text-white h-8 w-1/2 px-3 align-middle">Nama Pasien</td>
                            <td class="border border-gray-800 bg-[#6A9DF6] text-white h-8 w-1/2 px-3 align-middle">Status / Tindakan</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-800 h-8 px-3 align-middle text-gray-700">1. Tn. Ahmad Dhani</td>
                            <td class="border border-gray-800 h-8 px-3 align-middle text-gray-700">Pemeriksaan Dokter - <span class="text-orange-500 font-semibold">Menunggu</span></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-800 h-8 px-3 align-middle text-gray-700">2. Ny. Budi Santoso</td>
                            <td class="border border-gray-800 h-8 px-3 align-middle text-gray-700">Ambil Obat - <span class="text-green-600 font-semibold">Selesai</span></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-800 h-8 px-3 align-middle text-gray-700">3. An. Siti Aminah</td>
                            <td class="border border-gray-800 h-8 px-3 align-middle text-gray-700">Konsultasi Gigi - <span class="text-blue-500 font-semibold">Diperiksa</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</x-clinic-layout>
