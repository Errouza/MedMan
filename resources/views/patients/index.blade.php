@if(Auth::user()->role === 'admin')
<x-clinic-layout>
        
        <div x-data="{ tab: '{{ (isset($searchPerformed) && $searchPerformed) || !session('success') ? 'data' : 'registrasi' }}' }" class="flex flex-col gap-6 w-full">
            
            @if(session('success'))
            <div class="mb-2 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-lg">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                    <span class="text-green-800 font-bold">{{ session('success') }}</span>
                </div>
            </div>
            @endif

            <!-- Tab Navigation -->
            <div class="bg-white rounded-full p-2 flex gap-2 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 w-fit">
                <button @click="tab = 'registrasi'" :class="tab === 'registrasi' ? 'bg-[#0A3D74] text-white shadow-md' : 'text-gray-500 hover:text-[#0A3D74] hover:bg-blue-50'" class="px-8 py-2.5 rounded-full text-[13px] font-[900] transition-all duration-300 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    Registrasi Pasien Baru
                </button>
                <button @click="tab = 'data'" :class="tab === 'data' ? 'bg-[#0A3D74] text-white shadow-md' : 'text-gray-500 hover:text-[#0A3D74] hover:bg-blue-50'" class="px-8 py-2.5 rounded-full text-[13px] font-[900] transition-all duration-300 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Cari Data Pasien
                </button>
            </div>

            <!-- Tab Content: Registrasi Pasien -->
            <div x-show="tab === 'registrasi'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                <!-- Section 2: Registrasi Pasien -->
                <div class="bg-white rounded-[24px] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 p-8 w-full">
                    <h3 class="text-[20px] font-[900] text-[#0A3D74] mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-[#6A9DF6]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        Registrasi Pasien Baru
                    </h3>
                    <form action="{{ route('patients.store') }}" method="POST">
                        @csrf
                        <div class="flex gap-10 mb-6">
                            <!-- Kolom Kiri -->
                            <div class="flex flex-col gap-6 w-1/2">
                                <div class="flex flex-col w-full border-b-[2px] border-gray-200 focus-within:border-[#6A9DF6] transition-colors pb-1">
                                    <label class="text-[13px] font-extrabold text-[#0A3D74] mb-1">Nama Pasien</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border-none px-0 py-1 text-[15px] text-gray-800 font-bold focus:ring-0 bg-transparent placeholder-gray-300" placeholder="Masukkan nama lengkap" required>
                                </div>
                                <div class="flex flex-col gap-1.5 w-full mt-1">
                                    <label class="text-[13px] font-extrabold text-[#0A3D74]">Tanggal Lahir</label>
                                    <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="w-[60%] border-[2px] border-gray-200 rounded-[12px] px-4 py-2.5 text-[14px] text-gray-800 font-bold focus:border-[#6A9DF6] focus:ring-0 bg-white transition-colors">
                                </div>
                                <div class="flex flex-col w-full border-b-[2px] border-gray-200 focus-within:border-[#6A9DF6] transition-colors pb-1 mt-2">
                                    <label class="text-[13px] font-extrabold text-[#0A3D74] mb-1">No. HP</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="w-full border-none px-0 py-1 text-[15px] text-gray-800 font-bold focus:ring-0 bg-transparent placeholder-gray-300" placeholder="Contoh: 08123456789" required>
                                </div>
                                <div class="flex flex-col w-full border-b-[2px] border-gray-200 focus-within:border-[#6A9DF6] transition-colors pb-1 mt-2">
                                    <label class="text-[13px] font-extrabold text-[#0A3D74] mb-1">Alamat</label>
                                    <input type="text" name="address" value="{{ old('address') }}" class="w-full border-none px-0 py-1 text-[15px] text-gray-800 font-bold focus:ring-0 bg-transparent placeholder-gray-300" placeholder="Masukkan alamat lengkap">
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="bg-[#0A3D74] hover:bg-[#6A9DF6] text-white font-[900] text-[13px] px-8 py-3.5 rounded-[12px] transition-colors shadow-[0_4px_10px_rgba(10,61,116,0.2)] hover:shadow-[0_4px_15px_rgba(106,157,246,0.3)] tracking-wide">
                                        BUAT ANTREAN SEKARANG
                                    </button>
                                </div>
                            </div>
                            <!-- Kolom Kanan -->
                            <div class="flex flex-col gap-6 w-1/2">
                                <div class="flex flex-col w-full border-b-[2px] border-gray-200 focus-within:border-[#6A9DF6] transition-colors pb-1">
                                    <label class="text-[13px] font-extrabold text-[#0A3D74] mb-1">Nomor Induk Kependudukan (NIK)</label>
                                    <input type="text" name="nik" value="{{ old('nik') }}" inputmode="numeric" maxlength="16" minlength="16" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="w-full border-none px-0 py-1 text-[15px] text-gray-800 font-bold focus:ring-0 bg-transparent placeholder-gray-300" placeholder="Masukkan 16 digit NIK" required>
                                </div>
                                @error('nik')
                                    <p class="text-red-500 text-[11px] font-bold mt-1 flex items-center gap-1 bg-red-50 px-2 py-1 rounded-md w-fit">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $message }}
                                    </p>
                                @enderror

                                <div class="flex flex-col gap-1.5 w-full mt-1">
                                    <label class="text-[13px] font-extrabold text-[#0A3D74]">Jenis Kelamin</label>
                                    <div class="flex gap-4 mt-1">
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="gender" value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'checked' : '' }} class="w-4 h-4 accent-[#0A3D74] cursor-pointer">
                                            <span class="text-[14px] font-bold text-gray-700 group-hover:text-[#0A3D74] transition-colors">
                                                <svg class="w-4 h-4 inline text-[#6A9DF6] mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M9 9c0-2.21 1.79-4 4-4s4 1.79 4 4-1.79 4-4 4-4-1.79-4-4zm0 0"/><path d="M17.66 4.34C16.18 2.86 14.18 2 12 2 7.58 2 4 5.58 4 10c0 3.54 2.29 6.53 5.46 7.59L8 20h2v2h2v-2h2v-2h2l-1.46-2.41C17.71 16.53 20 13.54 20 10c0-2.18-.86-4.18-2.34-5.66zM6 10c0-3.31 2.69-6 6-6s6 2.69 6 6-2.69 6-6 6-6-2.69-6-6z"/></svg>
                                                Laki-laki
                                            </span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer group">
                                            <input type="radio" name="gender" value="Perempuan" {{ old('gender') == 'Perempuan' ? 'checked' : '' }} class="w-4 h-4 accent-[#0A3D74] cursor-pointer">
                                            <span class="text-[14px] font-bold text-gray-700 group-hover:text-[#0A3D74] transition-colors">
                                                <svg class="w-4 h-4 inline text-pink-400 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C9.24 2 7 4.24 7 7s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 8c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm1 2h-2v3H8v2h3v3h2v-3h3v-2h-3v-3z"/></svg>
                                                Perempuan
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-1.5 w-full mt-2">
                                    <label class="text-[13px] font-extrabold text-[#0A3D74]">Pekerjaan</label>
                                    <select name="occupation" class="w-full border-[2px] border-gray-200 rounded-[12px] px-4 py-2.5 text-[14px] text-gray-800 font-bold focus:border-[#6A9DF6] focus:ring-0 bg-white transition-colors">
                                        <option value="" disabled {{ old('occupation') ? '' : 'selected' }}>Pilih Pekerjaan</option>
                                        <option value="PNS / ASN" {{ old('occupation') == 'PNS / ASN' ? 'selected' : '' }}>PNS / ASN</option>
                                        <option value="TNI / Polri" {{ old('occupation') == 'TNI / Polri' ? 'selected' : '' }}>TNI / Polri</option>
                                        <option value="Pegawai Swasta" {{ old('occupation') == 'Pegawai Swasta' ? 'selected' : '' }}>Pegawai Swasta</option>
                                        <option value="Wiraswasta" {{ old('occupation') == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                                        <option value="Petani / Nelayan" {{ old('occupation') == 'Petani / Nelayan' ? 'selected' : '' }}>Petani / Nelayan</option>
                                        <option value="Pelajar / Mahasiswa" {{ old('occupation') == 'Pelajar / Mahasiswa' ? 'selected' : '' }}>Pelajar / Mahasiswa</option>
                                        <option value="Ibu Rumah Tangga" {{ old('occupation') == 'Ibu Rumah Tangga' ? 'selected' : '' }}>Ibu Rumah Tangga</option>
                                        <option value="Pensiunan" {{ old('occupation') == 'Pensiunan' ? 'selected' : '' }}>Pensiunan</option>
                                        <option value="Tidak Bekerja" {{ old('occupation') == 'Tidak Bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                                        <option value="Lainnya" {{ old('occupation') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Generate Nomor Urut Section -->
                    <div class="mt-10 bg-[#F4F6FC] rounded-[20px] p-8 border border-[#EBF4FF]">
                        <p class="text-[12px] font-[900] text-gray-500 uppercase tracking-widest mb-6">Generate Nomor Urut :</p>
                        <div class="flex items-start gap-16">
                            <div class="flex flex-col">
                                <span class="text-[13px] font-extrabold text-[#0A3D74] mb-2">No. Urut Antrian Hari Ini</span>
                                @php
                                    $todayCount = \App\Models\Patient::whereDate('created_at', \Carbon\Carbon::today())->count() + 1;
                                @endphp
                                <span class="text-[64px] font-[900] text-[#6A9DF6] leading-none tracking-tighter drop-shadow-sm" style="font-family: 'Inter', sans-serif;">{{ $todayCount }}</span>
                            </div>
                            <div class="grid grid-cols-3 gap-x-12 gap-y-6 pt-2">
                                <div class="flex flex-col">
                                    <span class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider mb-0.5">Nama Pasien</span>
                                    <span class="text-[14px] font-bold text-[#0A3D74]">{{ $patients->first()->name ?? '-' }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider mb-0.5">Tanggal Lahir</span>
                                    <span class="text-[14px] font-bold text-[#0A3D74]">{{ $patients->first()->birth_date ?? '-' }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider mb-0.5">Alamat</span>
                                    <span class="text-[14px] font-bold text-[#0A3D74]">{{ $patients->first()->address ?? '-' }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider mb-0.5">NIK</span>
                                    <span class="text-[14px] font-bold text-[#0A3D74]">{{ $patients->first()->nik ?? '-' }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider mb-0.5">No. Hp</span>
                                    <span class="text-[14px] font-bold text-[#0A3D74]">{{ $patients->first()->phone ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Cari Data Pasien -->
            <div x-show="tab === 'data'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;" x-cloak>
                <!-- Section 1: Cari Data Pasien -->
                <div class="bg-white rounded-[24px] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 p-8 w-full">
                    <h3 class="text-[20px] font-[900] text-[#0A3D74] mb-5 flex items-center gap-2">
                        <svg class="w-6 h-6 text-[#6A9DF6]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Cari Data Pasien
                    </h3>
                    <form action="{{ route('patients.index') }}" method="GET" class="flex items-end gap-5">
                        <div class="flex flex-col gap-2 flex-1">
                            <label class="text-[13px] font-extrabold text-[#0A3D74]">Isi Nama Pasien</label>
                            <input type="text" name="search_name" value="{{ request('search_name') }}" placeholder="Isi disini" class="w-full border-[2.5px] border-gray-200 rounded-[12px] px-4 py-3 text-[14px] text-gray-800 font-bold focus:border-[#6A9DF6] focus:ring-0 placeholder-gray-400 transition-colors">
                        </div>
                        <div class="flex flex-col gap-2 flex-1">
                            <label class="text-[13px] font-extrabold text-[#0A3D74]">Isi NIK Pasien</label>
                            <input type="text" name="search_nik" value="{{ request('search_nik') }}" inputmode="numeric" maxlength="16" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Isi disini" class="w-full border-[2.5px] border-gray-200 rounded-[12px] px-4 py-3 text-[14px] text-gray-800 font-bold focus:border-[#6A9DF6] focus:ring-0 placeholder-gray-400 transition-colors">
                        </div>
                        <button type="submit" class="w-[52px] h-[52px] bg-[#0A3D74] rounded-[12px] flex justify-center items-center hover:bg-[#6A9DF6] transition-colors flex-shrink-0 shadow-md">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                        @if(request()->filled('search_name') || request()->filled('search_nik'))
                        <a href="{{ route('patients.index') }}" class="w-[52px] h-[52px] bg-red-50 text-red-500 rounded-[12px] flex justify-center items-center hover:bg-red-500 hover:text-white transition-colors flex-shrink-0 shadow-md" title="Reset Pencarian">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </a>
                        @endif
                    </form>

                    <!-- Hasil Pencarian -->
                    @if(isset($searchPerformed) && $searchPerformed)
                        <div class="mt-8 pt-6 border-t-[2px] border-gray-100">
                            <h4 class="text-[14px] font-[900] text-gray-500 uppercase tracking-widest mb-4">Hasil Pencarian :</h4>
                            
                            @if($patients->count() > 0)
                                <div class="grid grid-cols-1 gap-4 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar">
                                    @foreach($patients as $patient)
                                        <div class="flex items-center justify-between bg-[#F4F6FC] rounded-[16px] p-5 border border-[#EBF4FF] hover:border-[#6A9DF6] transition-colors">
                                            <div class="flex items-center gap-6">
                                                <div class="w-12 h-12 bg-[#0A3D74] rounded-full flex items-center justify-center text-white font-bold text-lg shadow-sm">
                                                    {{ substr($patient->name, 0, 1) }}
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="text-[16px] font-[900] text-[#0A3D74]">{{ $patient->name }}</span>
                                                    <span class="text-[12px] font-bold text-gray-500 mt-0.5">NIK: {{ $patient->nik }} &nbsp;|&nbsp; HP: {{ $patient->phone ?? '-' }}</span>
                                                </div>
                                            </div>
                                            <div class="flex gap-2">
                                                <a href="{{ route('patients.show', $patient) }}" class="bg-gray-100 hover:bg-[#0A3D74] hover:text-white text-gray-600 font-[900] text-[12px] px-4 py-2.5 rounded-[10px] transition-colors shadow-sm tracking-widest uppercase flex items-center gap-2">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                    Riwayat
                                                </a>
                                                <form action="{{ route('patients.new_visit', $patient) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="bg-[#6A9DF6] hover:bg-[#0A3D74] text-white font-[900] text-[12px] px-6 py-2.5 rounded-[10px] transition-colors shadow-sm tracking-widest uppercase flex items-center gap-2">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                                        Buat Kunjungan
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="bg-orange-50 border border-orange-200 rounded-[16px] p-6 text-center">
                                    <div class="w-12 h-12 bg-orange-100 text-orange-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    </div>
                                    <h5 class="text-[15px] font-[900] text-orange-800 mb-1">Data Pasien Tidak Ditemukan</h5>
                                    <p class="text-[13px] text-orange-600 font-bold mb-4">Pasien dengan nama atau NIK tersebut belum pernah terdaftar di sistem.</p>
                                    <button @click="tab = 'registrasi'" class="bg-orange-500 hover:bg-orange-600 text-white font-[900] text-[12px] px-6 py-2.5 rounded-[10px] transition-colors shadow-sm tracking-widest uppercase inline-block">
                                        Pergi ke Registrasi Baru
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

        </div>
</x-clinic-layout>
@else
<x-doctor-layout>
    <!-- Table -->
    <div class="w-full overflow-x-auto mt-4">
        <table class="w-full text-left min-w-[800px]">
            <thead>
                <tr class="border-b-[2px] border-gray-100">
                    <th class="pb-5 px-4 text-[14px] font-[900] text-black tracking-wide">Rekam Medis</th>
                    <th class="pb-5 px-4 text-[14px] font-[900] text-black tracking-wide text-center">Nama Pasien</th>
                    <th class="pb-5 px-4 text-[14px] font-[900] text-black tracking-wide text-center">NIK</th>
                    <th class="pb-5 px-4 text-[14px] font-[900] text-black tracking-wide text-center">Tanggal</th>
                    <th class="pb-5 px-4"></th>
                </tr>
            </thead>
            <tbody class="divide-y-[2px] divide-gray-50">
                @forelse($patients ?? [] as $index => $patient)
                @php
                    $isWaiting = $patient->status === 'waiting';
                    $isInProgress = $patient->status === 'in_progress';
                    $textColor = $isInProgress ? 'text-[#6A9DF6]' : 'text-gray-500';
                    $nameColor = $isInProgress ? 'text-[#0A3D74]' : 'text-gray-700';
                @endphp
                <tr class="hover:bg-blue-50/50 transition-colors group {{ $isInProgress ? 'bg-blue-50/30' : '' }}">
                    <td class="py-6 px-4 text-[14px] font-[800] {{ $textColor }}">{{ $patient->medical_record_number }}</td>
                    <td class="py-6 px-4 text-center">
                        <div class="flex flex-col items-center">
                            <span class="text-[14px] font-[800] {{ $nameColor }}">{{ $patient->name }}</span>
                            <span class="text-[10px] font-bold text-gray-400 mt-0.5">{{ $patient->phone ?? '-' }} | {{ $patient->address ?? '-' }}</span>
                        </div>
                    </td>
                    <td class="py-6 px-4 text-[14px] font-[800] {{ $textColor }} text-center">{{ $patient->nik }}</td>
                    <td class="py-6 px-4 text-[14px] font-[800] {{ $textColor }} text-center">{{ $patient->created_at->format('j M H:i, Y') }}</td>
                    <td class="py-6 px-4 text-right">
                        @if($isWaiting)
                            <form action="{{ route('patients.update_status', $patient) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="in_progress">
                                <button type="submit" class="bg-[#4B5563] hover:bg-gray-700 text-white font-[800] text-[12px] px-6 py-2.5 rounded-[10px] transition-colors shadow-sm tracking-wide">
                                    Terima Pasien
                                </button>
                            </form>
                        @elseif($isInProgress)
                            <a href="{{ route('patients.diagnose', $patient) }}" class="text-white bg-[#6A9DF6] hover:bg-[#0A3D74] font-[900] text-[12px] px-6 py-2.5 rounded-[10px] transition-colors shadow-sm uppercase tracking-wider inline-flex items-center gap-2">
                                <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                Sedang Diperiksa
                            </a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-16 text-center">
                        <div class="flex flex-col items-center justify-center text-gray-400">
                            <svg class="w-12 h-12 mb-3 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            <span class="font-bold text-[14px]">Belum ada daftar pasien.</span>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-doctor-layout>
@endif
