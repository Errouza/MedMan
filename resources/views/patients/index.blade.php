<x-clinic-layout>
    @if(Auth::user()->role === 'admin')
        
        <!-- UI Page Patients untuk Admin -->
        <div class="bg-white rounded-2xl shadow-[0_0_15px_rgba(0,0,0,0.03)] border border-gray-100 p-8 w-full">
            
            @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-lg">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                    <span class="text-green-800 font-bold">{{ session('success') }}</span>
                </div>
            </div>
            @endif

            <form action="{{ route('patients.store') }}" method="POST" class="flex flex-col gap-6 mb-8 w-full">
                @csrf
                
                <!-- Isi Nama Pasien -->
                <div class="flex flex-col gap-1.5 w-full">
                    <label class="text-[15px] font-extrabold text-black">Isi Nama Pasien</label>
                    <input type="text" name="name" placeholder="Isi disini" class="w-full border-[2.5px] border-[#A8A29E] rounded-[10px] px-4 py-2.5 text-[14px] text-gray-700 font-bold focus:border-[#6A9DF6] focus:ring-[#6A9DF6] placeholder-gray-300">
                </div>

                <!-- NIK -->
                <div class="flex flex-col gap-1 w-full relative">
                    <label class="text-[15px] font-extrabold text-black">NIK</label>
                    <input type="text" name="nik" placeholder="Isi disini" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" minlength="16" maxlength="16" pattern="\d{16}" class="peer w-full border-[2.5px] border-[#A8A29E] rounded-[10px] px-4 py-2.5 text-[14px] text-gray-700 font-bold focus:border-[#6A9DF6] focus:ring-[#6A9DF6] placeholder-gray-300 focus:invalid:border-red-500 focus:invalid:ring-red-500" required>
                    <p class="hidden peer-[&:not(:placeholder-shown):invalid]:block text-red-500 text-[11px] font-bold mt-1 px-1">
                        ⚠️ Peringatan: NIK belum lengkap! (Harus pas 16 digit angka)
                    </p>
                </div>

                <!-- No. HP -->
                <div class="flex flex-col gap-1.5 w-full">
                    <label class="text-[15px] font-extrabold text-black">No. HP</label>
                    <input type="text" name="phone" placeholder="Isi disini" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" minlength="10" maxlength="15" pattern="\d+" title="Nomor HP harus berupa angka" class="w-full border-[2.5px] border-[#A8A29E] rounded-[10px] px-4 py-2.5 text-[14px] text-gray-700 font-bold focus:border-[#6A9DF6] focus:ring-[#6A9DF6] placeholder-gray-300" required>
                </div>

                <!-- Gejala Pasien -->
                <div class="flex flex-col gap-1.5 w-full">
                    <label class="text-[15px] font-extrabold text-black">Gejala</label>
                    <input type="text" name="gejala" placeholder="Isi disini" class="w-full border-[2.5px] border-[#A8A29E] rounded-[10px] px-4 py-2.5 text-[14px] text-gray-700 font-bold focus:border-[#6A9DF6] focus:ring-[#6A9DF6] placeholder-gray-300">
                </div>

                <!-- Tindakan -->
                <div class="flex flex-col gap-1.5 w-full">
                    <label class="text-[15px] font-extrabold text-black">Tindakan</label>
                    <input type="text" name="tindakan" placeholder="Isi disini" class="w-full border-[2.5px] border-[#A8A29E] rounded-[10px] px-4 py-2.5 text-[14px] text-gray-700 font-bold focus:border-[#6A9DF6] focus:ring-[#6A9DF6] placeholder-gray-300">
                </div>

                <div>
                    <button type="submit" class="mt-2 bg-[#6A9DF6] text-white font-bold text-[14px] px-10 py-2.5 rounded-[20px] hover:bg-blue-600 transition-colors">Simpan</button>
                </div>
            </form>

            <!-- Rekam Medis Table -->
            <div class="mt-10">
                <h3 class="text-[16px] font-extrabold text-black mb-3">Rekam Medis</h3>
                <table class="w-full border-collapse border border-gray-300 text-sm">
                    <thead>
                        <tr>
                            <th class="bg-[#6A9DF6] border border-gray-300 text-white font-extrabold px-3 py-2 text-left">Nama Pasien</th>
                            <th class="bg-[#6A9DF6] border border-gray-300 text-white font-extrabold px-3 py-2 text-left">Gejala Pasien</th>
                            <th class="bg-[#6A9DF6] border border-gray-300 text-white font-extrabold px-3 py-2 text-left">Tindakan yang Diberikan</th>
                            <th class="bg-[#6A9DF6] border border-gray-300 text-white font-extrabold px-3 py-2 text-center w-[160px]">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($patients ?? [] as $patient)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="border border-gray-300 px-3 py-2.5 font-bold text-gray-800">{{ $patient->name }}</td>
                            <td class="border border-gray-300 px-3 py-2.5 text-gray-600 font-medium">{{ $patient->gejala ?? '-' }}</td>
                            <td class="border border-gray-300 px-3 py-2.5 text-gray-600 font-medium">{{ $patient->tindakan ?? '-' }}</td>
                            <td class="border border-gray-300 px-3 py-2.5 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="#" class="bg-blue-500 text-white px-2.5 py-1 rounded text-[10px] uppercase font-bold hover:bg-blue-600 transition-colors cursor-pointer title="Lihat Profil">Lihat</a>
                                    <a href="#" class="bg-amber-500 text-white px-2.5 py-1 rounded text-[10px] uppercase font-bold hover:bg-amber-600 transition-colors cursor-pointer title="Edit">Edit</a>
                                    <a href="#" class="bg-red-500 text-white px-2.5 py-1 rounded text-[10px] uppercase font-bold hover:bg-red-600 transition-colors cursor-pointer title="Hapus">Hapus</a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="border border-gray-300 px-4 py-8 text-center text-gray-500 font-medium italic">Data rekam medis belum tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    @else
        
        <!-- UI Page Patients untuk Doctor -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 w-full max-w-7xl">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Papan Medis Dokter</h2>
            <div class="text-gray-500">
                Area ini khusus untuk tugas dokter. UI khusus penanganan medis (Antrean, Rekam Medis Detail) akan kami buatkan ruangannya tersendiri di sini nanti.
            </div>
        </div>

    @endif
</x-clinic-layout>
