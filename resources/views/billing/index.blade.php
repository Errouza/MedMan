<x-clinic-layout>
    <div class="w-full max-w-5xl mx-auto py-8">
        <!-- Back Button -->
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-[13px] font-[900] text-gray-500 hover:text-[#0A3D74] mb-6 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Dashboard
        </a>

        <div class="bg-white rounded-[24px] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 p-10" x-data="{
                baseTotal: {{ $patient->harga ?? 0 }},
                items: [
                    @if($prescriptions && $prescriptions->items->count() > 0)
                        @foreach($prescriptions->items as $item)
                            { id: {{ $item->id }}, name: '{{ addslashes($item->medicine->name ?? 'Obat') }}', price: 0, qty: {{ $item->jumlah }} },
                        @endforeach
                    @endif
                ],
                get grandTotal() {
                    let t = this.baseTotal;
                    this.items.forEach(i => {
                        let p = parseFloat(i.price) || 0;
                        t += (p * i.qty);
                    });
                    return t;
                },
                paymentMethod: 'cash',
                showQrisModal: false,
                showSuccessModal: false,
                submitForm() {
                    this.showQrisModal = false;
                    this.showSuccessModal = true;
                },
                executePrintAndSubmit() {
                    window.print();
                    setTimeout(() => {
                        document.getElementById('billingForm').submit();
                    }, 1000);
                },
                executeSubmitOnly() {
                    document.getElementById('billingForm').submit();
                }
            }">
            <!-- Header Pasien -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-10 pb-8 border-b-[3px] border-gray-100">
                <div class="md:col-span-2">
                    <h3 class="text-[12px] font-[900] text-black tracking-wide mb-1">No. Urut Antrian</h3>
                    <p class="text-[32px] font-[900] text-[#6A9DF6] leading-none">{{ $patient->queue_number ?? '-' }}</p>
                </div>
                <div class="md:col-span-4 overflow-hidden">
                    <h3 class="text-[12px] font-[900] text-black tracking-wide mb-1">No.Rekam Medis</h3>
                    <p class="text-[20px] lg:text-[26px] font-[900] text-[#6A9DF6] leading-none tracking-tight truncate">{{ $patient->medical_record_number }}</p>
                </div>

                <div class="md:col-span-6 grid grid-cols-2 gap-y-4 gap-x-6 pl-0 md:pl-6 border-t md:border-t-0 md:border-l-[2px] border-gray-100 pt-4 md:pt-0">
                    <div class="overflow-hidden">
                        <h3 class="text-[12px] font-[900] text-black tracking-wide mb-1">Nama Pasien</h3>
                        <p class="text-[14px] font-[900] text-[#6A9DF6] truncate">{{ $patient->name }}</p>
                    </div>
                    <div class="overflow-hidden">
                        <h3 class="text-[12px] font-[900] text-black tracking-wide mb-1">Tanggal Lahir</h3>
                        <p class="text-[14px] font-[900] text-[#6A9DF6] truncate">{{ \Carbon\Carbon::parse($patient->birth_date)->format('d M Y') }}</p>
                    </div>
                    <div class="overflow-hidden">
                        <h3 class="text-[12px] font-[900] text-black tracking-wide mb-1">NIK</h3>
                        <p class="text-[14px] font-[900] text-[#6A9DF6] truncate">{{ $patient->nik }}</p>
                    </div>
                    <div class="overflow-hidden">
                        <h3 class="text-[12px] font-[900] text-black tracking-wide mb-1">No. Hp</h3>
                        <p class="text-[14px] font-[900] text-[#6A9DF6] truncate">{{ $patient->phone ?? '-' }}</p>
                    </div>
                    <div class="col-span-2 overflow-hidden">
                        <h3 class="text-[12px] font-[900] text-black tracking-wide mb-1">Alamat</h3>
                        <p class="text-[14px] font-[900] text-[#6A9DF6] truncate">{{ $patient->address ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Tabel Rincian -->
            <h2 class="text-[18px] font-[900] text-black mb-4 tracking-tight">Rincian Pembayaran</h2>
            <div class="border-[2px] border-black rounded-sm overflow-x-auto mb-8">
                <table class="w-full text-left min-w-[500px]">
                    <thead>
                        <tr class="bg-[#6A9DF6] text-black border-b-[2px] border-black">
                            <th class="py-2.5 px-4 text-[15px] font-[900] border-r-[2px] border-black w-2/3">Treatment / Tindakan</th>
                            <th class="py-2.5 px-4 text-[15px] font-[900]">Harga</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-[2px] divide-black font-[900] text-[14px] text-gray-700">
                        @php
                        $total = 0;
                        @endphp

                        <!-- Biaya Layanan Dokter -->
                        @if($patient->harga > 0)
                        @php $total += $patient->harga; @endphp
                        <tr>
                            <td class="py-3 px-4 border-r-[2px] border-black">Biaya Layanan Medis / Tindakan Dokter</td>
                            <td class="py-3 px-4 whitespace-nowrap">Rp. {{ number_format($patient->harga, 0, ',', '.') }}</td>
                        </tr>
                        @endif

                        <!-- Obat-obatan -->
                        @if($prescriptions && $prescriptions->items->count() > 0)
                        @foreach($prescriptions->items as $loopIndex => $item)
                        <tr>
                            <td class="py-3 px-4 border-r-[2px] border-black flex items-center flex-wrap gap-2">
                                <span class="font-bold text-[#0A3D74]">{{ $item->medicine->name ?? 'Obat' }}</span> 
                                <span class="text-gray-500 font-bold">({{ $item->jumlah }} x )</span>
                                <input type="hidden" name="items[{{ $item->id }}][id]" value="{{ $item->id }}">
                                <div class="flex items-center ml-auto">
                                    <span class="text-gray-500 font-bold mr-2">Rp</span>
                                    <input type="number" x-model.number="items.find(i => i.id == {{ $item->id }}).price" name="items[{{ $item->id }}][price]" class="w-32 border-2 border-gray-200 focus:border-[#6A9DF6] rounded-[8px] text-sm px-3 py-1.5 outline-none transition-colors font-bold text-[#0A3D74]" placeholder="Harga Satuan" min="0" required>
                                </div>
                            </td>
                            <td class="py-3 px-4 whitespace-nowrap">Rp. <span x-text="new Intl.NumberFormat('id-ID').format(items.find(i => i.id == {{ $item->id }}).price * {{ $item->jumlah }})"></span></td>
                        </tr>
                        @endforeach
                        @else
                        <!-- Placeholder Kosong untuk gaya tabel -->
                        <tr>
                            <td class="py-3 px-4 border-r-[2px] border-black">&nbsp;</td>
                            <td class="py-3 px-4"></td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 border-r-[2px] border-black">&nbsp;</td>
                            <td class="py-3 px-4"></td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 border-r-[2px] border-black">&nbsp;</td>
                            <td class="py-3 px-4"></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Footer Action -->
            <form action="{{ route('billing.store', $patient) }}" method="POST" id="billingForm" @submit.prevent="submitForm()" class="flex flex-wrap justify-between items-end gap-8 mt-12 relative">
                @csrf

                <div class="flex-1 flex flex-wrap items-end gap-6 min-w-[280px]">
                    <div class="overflow-hidden">
                        <h3 class="text-[13px] font-[900] text-black tracking-wide mb-1">Total Tagihan</h3>
                        <p class="text-[36px] lg:text-[48px] font-[900] text-[#6A9DF6] leading-none tracking-tighter whitespace-nowrap">Rp. <span x-text="new Intl.NumberFormat('id-ID').format(grandTotal)"></span></p>
                    </div>

                    <!-- Tombol Bayar -->
                    <button type="button" @click="showQrisModal = true" class="bg-[#0A3D74] hover:bg-[#6A9DF6] text-white font-[900] text-[15px] px-8 py-3.5 rounded-full transition-colors shadow-lg flex items-center gap-3 sm:mb-2 whitespace-nowrap shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                        </svg>
                        Bayar dgn QRIS
                    </button>
                </div>

                <div class="flex flex-wrap items-center gap-6 w-full lg:w-auto border-t lg:border-t-0 lg:border-l border-gray-200 pt-6 lg:pt-0 lg:pl-6">
                    <!-- Metode Pembayaran Cash -->
                    <div class="flex flex-col min-w-[200px]">
                        <label class="flex items-center gap-3 cursor-pointer group mb-1">
                            <div class="w-5 h-5 rounded-full border-[2.5px] flex items-center justify-center p-0.5 transition-colors shrink-0" :class="paymentMethod === 'cash' ? 'border-[#56C427]' : 'border-gray-300'">
                                <input type="radio" x-model="paymentMethod" name="payment_method" value="cash" class="hidden">
                                <div class="w-full h-full rounded-full transition-colors" :class="paymentMethod === 'cash' ? 'bg-[#56C427]' : 'bg-transparent'"></div>
                            </div>
                            <span class="font-[900] text-black tracking-tight text-[15px] whitespace-nowrap">
                                Pembayaran Tunai (Cash)
                            </span>
                        </label>
                        <p class="text-[11px] font-bold text-gray-400 pl-8 leading-tight max-w-[200px]">Pilih ini jika pasien membayar dengan uang tunai ke kasir.</p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4 shrink-0">
                        <button type="submit" class="bg-[#56C427] hover:bg-[#4CAF21] text-white font-[900] text-[15px] px-8 py-3.5 rounded-[12px] transition-colors shadow-sm tracking-wide shrink-0 whitespace-nowrap">
                            Selesai & Lunas
                        </button>
                    </div>
                </div>

                <!-- QRIS Modal Popup (STATIS) -->
                <div x-show="showQrisModal" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
                    <!-- Overlay -->
                    <div x-show="showQrisModal" x-transition.opacity @click="showQrisModal = false" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm"></div>

                    <!-- Modal Content -->
                    <div x-show="showQrisModal"
                        x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                        class="relative bg-white rounded-[32px] shadow-2xl p-8 max-w-md w-full text-center border border-gray-100">

                        <div class="absolute top-4 right-4">
                            <button type="button" @click="showQrisModal = false" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 text-gray-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="flex justify-center mb-2">
                            <div class="flex items-center gap-2 bg-[#0A3D74] px-4 py-1.5 rounded-full">
                                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                </svg>
                                <span class="text-white font-[900] text-[14px] tracking-widest">PEMBAYARAN QRIS</span>
                            </div>
                        </div>

                        <h2 class="text-[20px] font-bold text-gray-500 mt-4">Klinik MedMan</h2>
                        <p class="text-[36px] font-[900] text-[#6A9DF6] leading-none my-2">Rp. <span x-text="new Intl.NumberFormat('id-ID').format(grandTotal)"></span></p>
                        <p class="text-[13px] font-bold text-gray-400 mb-6">Scan kode QRIS ini menggunakan M-Banking atau e-Wallet Anda.</p>

                        <!-- Gambar QRIS Statis -->
                        <div class="bg-white p-3 rounded-[24px] border-[3px] border-gray-100 inline-block shadow-sm relative mb-8">
                            <img src="{{ asset('images/QRISbubulak.jpg') }}" alt="QRIS Code" class="w-[280px] h-auto object-contain rounded-[12px]">
                        </div>

                        <div class="flex gap-3">
                            <button type="button" @click="showQrisModal = false" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-[900] text-[14px] px-6 py-3.5 rounded-[16px] transition-colors">
                                Batal
                            </button>
                            <button type="button" @click="paymentMethod = 'qris'; submitForm()" class="flex-[2] bg-[#0A3D74] hover:bg-[#6A9DF6] text-white font-[900] text-[14px] px-6 py-3.5 rounded-[16px] transition-colors shadow-[0_4px_15px_rgba(10,61,116,0.3)] flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Verifikasi Pembayaran Lunas
                            </button>
                        </div>
                    </div>
                </div>

            </form>

            <!-- Success/Print Modal Popup -->
            <div x-show="showSuccessModal" style="display: none;" class="fixed inset-0 z-[110] flex items-center justify-center p-4">
                <!-- Overlay -->
                <div x-show="showSuccessModal" x-transition.opacity @click="showSuccessModal = false" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm"></div>

                <!-- Modal Content -->
                <div x-show="showSuccessModal"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                    x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                    class="relative bg-white rounded-[32px] shadow-2xl p-8 max-w-md w-full text-center border border-gray-100">

                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h2 class="text-[20px] font-bold text-gray-800 mb-2">Pembayaran Berhasil!</h2>
                    <p class="text-[14px] text-gray-500 mb-8">Apakah Anda ingin mencetak struk untuk pembayaran ini?</p>

                    <div class="flex flex-col gap-3">
                        <button type="button" @click="executePrintAndSubmit()" class="w-full bg-[#0A3D74] hover:bg-[#6A9DF6] text-white font-[900] text-[15px] px-6 py-4 rounded-[16px] transition-colors shadow-lg flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                            </svg>
                            Cetak Struk & Selesai
                        </button>
                        <button type="button" @click="executeSubmitOnly()" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-[900] text-[15px] px-6 py-4 rounded-[16px] transition-colors">
                            Selesai Tanpa Cetak
                        </button>
                    </div>
                </div>
            </div>

            <!-- Thermal Receipt Content (Hidden on screen, visible on print) -->
            <div id="receipt-content" style="display: none;">
                <div style="width: 80mm; font-family: monospace; font-size: 12px; margin: 0; color: black; background: white; padding: 10px; line-height: 1.4;">
                    <div style="text-align: center; margin-bottom: 10px;">
                        <h2 style="margin: 0; font-size: 16px; font-weight: bold;">KLINIK MEDMAN</h2>
                        <p style="margin: 0;">Jl. Bubulak, Bogor Jawa Barat</p>
                        <p style="margin: 0;">================================</p>
                    </div>
                    <div style="margin-bottom: 10px;">
                        <p style="margin: 0;">No RM  : {{ $patient->medical_record_number }}</p>
                        <p style="margin: 0;">Pasien : {{ $patient->name }}</p>
                        <p style="margin: 0;">Waktu  : {{ now()->format('d/m/Y H:i') }}</p>
                        <p style="margin: 0;">Kasir  : {{ Auth::user()->name ?? 'Admin' }}</p>
                        <p style="margin: 0;">================================</p>
                    </div>
                    <table style="width: 100%; text-align: left; font-size: 12px; border-collapse: collapse;">
                        @if($patient->harga > 0)
                        <tr><td colspan="2">Layanan Dokter</td></tr>
                        <tr>
                            <td style="padding-bottom: 5px;">1 x {{ number_format($patient->harga, 0, ',', '.') }}</td>
                            <td style="text-align: right; padding-bottom: 5px;">{{ number_format($patient->harga, 0, ',', '.') }}</td>
                        </tr>
                        @endif
                        
                        <template x-for="item in items">
                            <tbody style="border: none;">
                                <tr>
                                    <td colspan="2" x-text="item.name"></td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom: 5px;" x-text="item.qty + ' x ' + new Intl.NumberFormat('id-ID').format(item.price)"></td>
                                    <td style="text-align: right; padding-bottom: 5px;" x-text="new Intl.NumberFormat('id-ID').format(item.qty * item.price)"></td>
                                </tr>
                            </tbody>
                        </template>
                    </table>
                    <p style="margin: 10px 0 0 0;">================================</p>
                    <table style="width: 100%; text-align: left; font-size: 12px; font-weight: bold;">
                        <tr>
                            <td>TOTAL</td>
                            <td style="text-align: right;">Rp <span x-text="new Intl.NumberFormat('id-ID').format(grandTotal)"></span></td>
                        </tr>
                        <tr>
                            <td>METODE</td>
                            <td style="text-align: right; text-transform: uppercase;" x-text="paymentMethod"></td>
                        </tr>
                    </table>
                    <p style="margin: 10px 0 0 0;">================================</p>
                    <div style="text-align: center; margin-top: 10px;">
                        <p style="margin: 0;">Terima Kasih</p>
                        <p style="margin: 0;">Semoga Lekas Sembuh</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-clinic-layout>

<!-- Gaya khusus Print & Animasi -->
<style>
    @keyframes scan {
        0% {
            top: 5%;
        }

        50% {
            top: 95%;
        }

        100% {
            top: 5%;
        }
    }

    @media print {
        body * {
            visibility: hidden;
        }

        #receipt-content, #receipt-content * {
            visibility: visible;
        }

        #receipt-content {
            display: block !important;
            position: absolute;
            left: 0;
            top: 0;
            width: 80mm;
        }

        @page {
            size: 80mm auto;
            margin: 0;
        }
    }
</style>
