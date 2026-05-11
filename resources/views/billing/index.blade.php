<x-clinic-layout>
    <div class="w-full max-w-5xl mx-auto py-8">
        <!-- Back Button -->
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-[13px] font-[900] text-gray-500 hover:text-[#0A3D74] mb-6 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Dashboard
        </a>

        <div class="bg-white rounded-[24px] shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 p-10">
            <!-- Header Pasien -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-10 pb-8 border-b-[3px] border-gray-100">
                <div class="md:col-span-2">
                    <h3 class="text-[12px] font-[900] text-black tracking-wide mb-1">No. Urut Antrian</h3>
                    @php
                        // Calculate today's queue number (same logic as dashboard)
                        $todayPatients = \App\Models\Patient::whereDate('created_at', \Carbon\Carbon::parse($patient->created_at)->toDateString())
                                            ->latest()
                                            ->get();
                        $index = $todayPatients->search(function($p) use ($patient) { 
                            return $p->patient_id == $patient->patient_id; 
                        });
                        $queueNumber = $todayPatients->count() - $index;
                    @endphp
                    <p class="text-[32px] font-[900] text-[#6A9DF6] leading-none">{{ $queueNumber }}</p>
                </div>
                <div class="md:col-span-4">
                    <h3 class="text-[12px] font-[900] text-black tracking-wide mb-1">No.Rekam Medis</h3>
                    <p class="text-[26px] font-[900] text-[#6A9DF6] leading-none tracking-tight break-all pr-4">{{ $patient->medical_record_number }}</p>
                </div>
                
                <div class="md:col-span-6 grid grid-cols-2 gap-y-4 gap-x-6 pl-6 border-l-[2px] border-gray-100">
                    <div>
                        <h3 class="text-[12px] font-[900] text-black tracking-wide mb-1">Nama Pasien</h3>
                        <p class="text-[14px] font-[900] text-[#6A9DF6] truncate">{{ $patient->name }}</p>
                    </div>
                    <div>
                        <h3 class="text-[12px] font-[900] text-black tracking-wide mb-1">Tanggal Lahir</h3>
                        <p class="text-[14px] font-[900] text-[#6A9DF6] truncate">{{ \Carbon\Carbon::parse($patient->birth_date)->format('d M Y') }}</p>
                    </div>
                    <div>
                        <h3 class="text-[12px] font-[900] text-black tracking-wide mb-1">NIK</h3>
                        <p class="text-[14px] font-[900] text-[#6A9DF6] truncate">{{ $patient->nik }}</p>
                    </div>
                    <div>
                        <h3 class="text-[12px] font-[900] text-black tracking-wide mb-1">No. Hp</h3>
                        <p class="text-[14px] font-[900] text-[#6A9DF6] truncate">{{ $patient->phone ?? '-' }}</p>
                    </div>
                    <div class="col-span-2">
                        <h3 class="text-[12px] font-[900] text-black tracking-wide mb-1">Alamat</h3>
                        <p class="text-[14px] font-[900] text-[#6A9DF6] line-clamp-2">{{ $patient->address ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Tabel Rincian -->
            <h2 class="text-[18px] font-[900] text-black mb-4 tracking-tight">Rincian Pembayaran</h2>
            <div class="border-[2px] border-black rounded-sm overflow-hidden mb-8">
                <table class="w-full text-left">
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
                                <td class="py-3 px-4">Rp. {{ number_format($patient->harga, 0, ',', '.') }}</td>
                            </tr>
                        @endif

                        <!-- Obat-obatan -->
                        @if($prescriptions && $prescriptions->items->count() > 0)
                            @foreach($prescriptions->items as $item)
                                @php 
                                    $subtotalObat = ($item->medicine->price ?? 0) * $item->jumlah;
                                    $total += $subtotalObat;
                                @endphp
                                <tr>
                                    <td class="py-3 px-4 border-r-[2px] border-black">
                                        {{ $item->medicine->name ?? 'Obat' }} <span class="text-gray-400 font-bold ml-1">({{ $item->jumlah }} x Rp{{ number_format($item->medicine->price ?? 0, 0, ',', '.') }})</span>
                                    </td>
                                    <td class="py-3 px-4">Rp. {{ number_format($subtotalObat, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        @else
                            <!-- Placeholder Kosong untuk gaya tabel -->
                            <tr><td class="py-3 px-4 border-r-[2px] border-black">&nbsp;</td><td class="py-3 px-4"></td></tr>
                            <tr><td class="py-3 px-4 border-r-[2px] border-black">&nbsp;</td><td class="py-3 px-4"></td></tr>
                            <tr><td class="py-3 px-4 border-r-[2px] border-black">&nbsp;</td><td class="py-3 px-4"></td></tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Footer Action -->
            <form action="{{ route('billing.store', $patient) }}" method="POST" id="billingForm" x-data="{ 
                paymentMethod: 'qris', 
                showQrisModal: false,
                submitForm() {
                    if (this.paymentMethod === 'qris' && !this.showQrisModal) {
                        this.showQrisModal = true;
                    } else {
                        document.getElementById('billingForm').submit();
                    }
                }
            }" @submit.prevent="submitForm()" class="flex flex-col md:flex-row justify-between items-end gap-6 mt-12 relative">
                @csrf
                <div class="flex-1 w-full">
                    <h3 class="text-[13px] font-[900] text-black tracking-wide mb-1">Total</h3>
                    <p class="text-[42px] font-[900] text-[#6A9DF6] leading-none">Rp. {{ number_format($total, 0, ',', '.') }}</p>
                </div>
                
                <div class="flex flex-col md:flex-row items-end md:items-center gap-8 w-full md:w-auto">
                    <!-- Metode Pembayaran -->
                    <div class="flex flex-col">
                        <h3 class="text-[13px] font-[900] text-black tracking-wide mb-3">Pembayaran</h3>
                        <div class="flex flex-col gap-3">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <div class="w-5 h-5 rounded-full border-[2.5px] flex items-center justify-center p-0.5 transition-colors" :class="paymentMethod === 'qris' ? 'border-[#6A9DF6]' : 'border-gray-300'">
                                    <input type="radio" x-model="paymentMethod" name="payment_method" value="qris" class="hidden">
                                    <div class="w-full h-full rounded-full transition-colors" :class="paymentMethod === 'qris' ? 'bg-[#6A9DF6]' : 'bg-transparent'"></div>
                                </div>
                                <span class="font-[900] text-black tracking-tight text-[15px] flex items-center gap-1">
                                    QRIS <span class="text-[10px] bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full ml-1">Auto</span>
                                </span>
                            </label>
                            
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <div class="w-5 h-5 rounded-full border-[2.5px] flex items-center justify-center p-0.5 transition-colors" :class="paymentMethod === 'cash' ? 'border-[#6A9DF6]' : 'border-gray-300'">
                                    <input type="radio" x-model="paymentMethod" name="payment_method" value="cash" class="hidden">
                                    <div class="w-full h-full rounded-full transition-colors" :class="paymentMethod === 'cash' ? 'bg-[#6A9DF6]' : 'bg-transparent'"></div>
                                </div>
                                <span class="font-[900] text-black tracking-tight text-[15px]">
                                    Cash
                                </span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Buttons -->
                    <div class="flex gap-4">
                        <button type="button" onclick="window.print()" class="bg-[#6A9DF6] hover:bg-[#5b8ce0] text-white font-[900] text-[14px] px-8 py-3 rounded-[12px] transition-colors shadow-sm tracking-wide">
                            Print
                        </button>
                        <button type="submit" class="bg-[#FF5B5B] hover:bg-[#E84E4E] text-white font-[900] text-[14px] px-8 py-3 rounded-[12px] transition-colors shadow-sm tracking-wide">
                            Selesai
                        </button>
                    </div>
                </div>

                <!-- QRIS Modal Popup -->
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
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>

                        <div class="flex justify-center mb-2">
                            <div class="flex items-center gap-2 bg-[#0A3D74] px-4 py-1.5 rounded-full">
                                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                <span class="text-white font-[900] text-[14px] tracking-widest">QRIS PAYMENT</span>
                            </div>
                        </div>
                        
                        <h2 class="text-[20px] font-bold text-gray-500 mt-4">Klinik MedMan</h2>
                        <p class="text-[36px] font-[900] text-[#6A9DF6] leading-none my-2">Rp {{ number_format($total, 0, ',', '.') }}</p>
                        <p class="text-[13px] font-bold text-gray-400 mb-6">Scan QR Code di bawah menggunakan M-Banking atau e-Wallet Anda.</p>

                        <!-- Generated QR Code (Simulated with api.qrserver.com) -->
                        <div class="bg-white p-4 rounded-[24px] border-[3px] border-gray-100 inline-block shadow-sm relative mb-8 group">
                            <!-- Scanning Animation Line -->
                            <div class="absolute top-0 left-0 w-full h-1 bg-[#6A9DF6]/50 blur-[2px] animate-[scan_2s_ease-in-out_infinite]"></div>
                            
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=MEDMAN-PAY-{{ $patient->id }}-{{ $total }}" alt="QRIS Code" class="w-[200px] h-[200px] object-contain">
                            
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-white/80 backdrop-blur-sm rounded-[20px]">
                                <span class="text-[#0A3D74] font-[900] text-[14px] px-4 py-2 bg-blue-50 rounded-full border border-blue-100">Test QR Code</span>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <button type="button" @click="showQrisModal = false" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-[900] text-[14px] px-6 py-3.5 rounded-[16px] transition-colors">
                                Batal
                            </button>
                            <button type="button" @click="document.getElementById('billingForm').submit()" class="flex-[2] bg-[#56C427] hover:bg-[#4CAF21] text-white font-[900] text-[14px] px-6 py-3.5 rounded-[16px] transition-colors shadow-[0_4px_15px_rgba(86,196,39,0.3)] flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                Cek Status & Selesai
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</x-clinic-layout>

<!-- Gaya khusus Print & Animasi -->
<style>
@keyframes scan {
    0% { top: 5%; }
    50% { top: 95%; }
    100% { top: 5%; }
}
@media print {
    body * {
        visibility: hidden;
    }
    .max-w-5xl, .max-w-5xl * {
        visibility: visible;
    }
    .max-w-5xl {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        padding: 0 !important;
        box-shadow: none !important;
        border: none !important;
    }
    a, button {
        display: none !important;
    }
}
</style>
