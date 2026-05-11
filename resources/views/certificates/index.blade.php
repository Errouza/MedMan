<x-doctor-layout>
    <div class="w-full max-w-5xl mx-auto pb-20">
        <h2 class="text-[28px] font-[900] text-[#6A9DF6] mb-8">Buat Surat Keterangan Sakit</h2>

        @if(session('success'))
        <div class="mb-8 p-4 bg-green-50 border-l-4 border-[#56C427] rounded-r-lg shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-[#56C427] rounded-full flex items-center justify-center text-white"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg></div>
                <span class="text-green-800 font-bold text-[14px]">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        <form action="{{ route('certificates.store') }}" method="POST">
            @csrf
            
            <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm overflow-hidden p-10 relative">
                <!-- Kop Surat Dummy -->
                <div class="border-b-[3px] border-black pb-6 mb-8 flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-[#0A3D74] rounded-[16px] flex items-center justify-center text-white shadow-md">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div>
                            <h1 class="text-[24px] font-[900] text-[#0A3D74] tracking-tight">KLINIK MEDMAN</h1>
                            <p class="text-[14px] font-bold text-gray-600">Jl. Kesehatan Medis No. 123, Kota Sehat Raya</p>
                            <p class="text-[14px] font-bold text-gray-500">Telp: (021) 555-1234 | Email: info@medman.com</p>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mb-10">
                    <h2 class="text-[22px] font-[900] text-black uppercase underline decoration-[3px] underline-offset-4">Surat Keterangan Sakit</h2>
                    <p class="text-[14px] mt-3 font-[900] text-gray-400">Nomor: <span class="text-[#6A9DF6]">(Digenerate Otomatis oleh Sistem)</span></p>
                </div>

                <div class="space-y-8 px-4">
                    <!-- Paragraf Pembuka -->
                    <p class="text-[15px] font-bold text-gray-800 leading-relaxed">
                        Yang bertanda tangan di bawah ini, menerangkan bahwa:
                    </p>

                    <!-- Data Pasien -->
                    <div class="grid grid-cols-[150px_1fr] items-center gap-4 bg-gray-50 p-6 rounded-[16px] border border-gray-100">
                        <label class="text-[15px] font-[900] text-black">Nama Pasien</label>
                        <select name="patient_id" class="w-full border-[2.5px] border-[#6A9DF6] rounded-[12px] px-4 py-3 text-[15px] font-bold text-[#0A3D74] focus:ring-0 focus:border-[#4B82F6] appearance-none bg-white bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%236A9DF6%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E')] bg-[length:14px_14px] bg-no-repeat bg-[position:right_1.2rem_center]" required>
                            <option value="" disabled selected>Pilih Pasien (Sistem Akan Mengambil Umur & Pekerjaan)...</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->patient_id }}">{{ $patient->name }} (Usia: {{ \Carbon\Carbon::parse($patient->birth_date)->age }} Thn) - RM: {{ $patient->medical_record_number }}</option>
                            @endforeach
                        </select>
                        @error('patient_id') <span class="col-start-2 text-red-500 text-xs font-bold">{{ $message }}</span> @enderror
                    </div>

                    <!-- Paragraf Isi -->
                    <p class="text-[15px] font-bold text-gray-800 leading-relaxed">
                        Sedang dalam keadaan sakit dan membutuhkan istirahat karena alasan medis:
                    </p>

                    <div class="grid grid-cols-[150px_1fr] items-start gap-4">
                        <label class="text-[15px] font-[900] text-black mt-3">Alasan Medis</label>
                        <div>
                            <input type="text" name="reason" placeholder="Contoh: Gejala tifus / Demam tinggi" class="w-full border-[2.5px] border-[#6A9DF6] rounded-[12px] px-4 py-3 text-[15px] font-bold text-gray-800 focus:ring-0 focus:border-[#4B82F6]" required>
                            @error('reason') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <p class="text-[15px] font-bold text-gray-800 leading-relaxed">
                        Maka dari itu, pasien tersebut perlu diberikan izin istirahat:
                    </p>

                    <!-- Data Istirahat -->
                    <div class="grid grid-cols-[150px_1fr] items-center gap-4 bg-blue-50/50 p-6 rounded-[16px] border border-blue-100">
                        <label class="text-[15px] font-[900] text-black">Tujuan Izin</label>
                        <div>
                            <select name="type" class="w-full md:w-1/2 border-[2.5px] border-[#6A9DF6] rounded-[12px] px-4 py-3 text-[15px] font-bold text-[#0A3D74] focus:ring-0 focus:border-[#4B82F6] appearance-none bg-white bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%236A9DF6%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E')] bg-[length:14px_14px] bg-no-repeat bg-[position:right_1.2rem_center]" required>
                                <option value="" disabled selected>Pilih Instansi...</option>
                                <option value="sekolah">Sekolah / Kampus</option>
                                <option value="kerja">Tempat Kerja</option>
                            </select>
                        </div>
                        
                        <label class="text-[15px] font-[900] text-black mt-4">Selama</label>
                        <div class="flex gap-4 mt-4 items-center">
                            <input type="date" name="start_date" value="{{ date('Y-m-d') }}" class="w-[200px] border-[2.5px] border-[#6A9DF6] rounded-[12px] px-4 py-3 text-[15px] font-bold text-gray-800 focus:ring-0 focus:border-[#4B82F6]" required>
                            <span class="font-[900] text-gray-400">s/d</span>
                            <input type="date" name="end_date" value="{{ date('Y-m-d', strtotime('+2 days')) }}" class="w-[200px] border-[2.5px] border-[#6A9DF6] rounded-[12px] px-4 py-3 text-[15px] font-bold text-gray-800 focus:ring-0 focus:border-[#4B82F6]" required>
                        </div>
                    </div>

                    <!-- Paragraf Penutup -->
                    <p class="text-[15px] font-bold text-gray-800 leading-relaxed mt-4">
                        Demikian surat keterangan ini dibuat agar dapat dimaklumi dan dipergunakan seperlunya.
                    </p>

                    <!-- Tanda Tangan -->
                    <div class="flex justify-end mt-12 mb-8">
                        <div class="text-center">
                            <p class="text-[15px] font-bold text-gray-800 mb-16">{{ date('d F Y') }}</p>
                            <p class="text-[16px] font-[900] text-black underline decoration-2 underline-offset-4">dr. {{ Auth::user()->name ?? 'Dokter Pemeriksa' }}</p>
                            <p class="text-[13px] font-bold text-gray-500 mt-1">SIP: 123.456.789</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-8 mt-4">
                <button type="submit" class="bg-[#56C427] hover:bg-[#4CAF21] text-white font-[900] text-[15px] px-10 py-3.5 rounded-full transition-colors shadow-lg tracking-wide flex items-center gap-3">
                    <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    Tanda Tangani & Terbitkan
                </button>
            </div>
        </form>
        
        <!-- Riwayat Surat -->
        <div class="mt-16 pt-8 border-t-[3px] border-gray-100">
            <h3 class="text-[20px] font-[900] text-[#0A3D74] mb-6 flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Arsip Surat Keterangan Sakit
            </h3>
            <div class="overflow-x-auto bg-white rounded-[16px] border border-gray-200 shadow-sm">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b-[2.5px] border-gray-100 bg-gray-50">
                            <th class="py-4 px-6 text-[13px] font-[900] text-gray-500 uppercase tracking-widest">No. Surat</th>
                            <th class="py-4 px-6 text-[13px] font-[900] text-gray-500 uppercase tracking-widest">Pasien</th>
                            <th class="py-4 px-6 text-[13px] font-[900] text-gray-500 uppercase tracking-widest">Tujuan</th>
                            <th class="py-4 px-6 text-[13px] font-[900] text-gray-500 uppercase tracking-widest">Masa Izin</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-[1.5px] divide-gray-100">
                        @php
                            $recentCertificates = \App\Models\Certificate::with('patient')->latest()->take(5)->get();
                        @endphp
                        @forelse($recentCertificates as $cert)
                        <tr class="hover:bg-blue-50/30 transition-colors">
                            <td class="py-4 px-6">
                                <span class="font-[900] text-[#6A9DF6] text-[14px]">{{ $cert->certificate_number }}</span>
                                <div class="text-[12px] font-bold text-gray-400 mt-0.5">{{ $cert->created_at->format('d M Y') }}</div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="text-[15px] font-[900] text-[#0A3D74]">{{ $cert->patient->name ?? '-' }}</div>
                                <div class="text-[13px] font-bold text-gray-500">{{ $cert->reason }}</div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 bg-{{ $cert->type == 'sekolah' ? 'blue' : 'purple' }}-50 text-{{ $cert->type == 'sekolah' ? 'blue' : 'purple' }}-600 rounded-full text-[12px] font-[900] uppercase tracking-wider">
                                    {{ $cert->type }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-[14px] font-[900] text-gray-600">
                                {{ \Carbon\Carbon::parse($cert->start_date)->format('d M') }} <span class="text-gray-300 mx-1">→</span> {{ \Carbon\Carbon::parse($cert->end_date)->format('d M Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center text-[15px] font-bold text-gray-400">Belum ada arsip surat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-doctor-layout>
