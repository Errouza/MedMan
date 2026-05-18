<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan Sehat - {{ $patient->name }}</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=times-new-roman:400,700&display=swap" rel="stylesheet" />
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            color: black;
            background-color: white;
            line-height: 1.5;
        }
        @media print {
            body { margin: 0; padding: 0; }
            .no-print { display: none !important; }
            .print-container { width: 100%; max-width: 100%; border: none; box-shadow: none; padding: 0; margin: 0; }
        }
        .print-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 40px 60px;
            background: white;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    
    <!-- Action Button (No Print) -->
    <div class="no-print fixed top-5 right-5 flex gap-4">
        <button onclick="window.close()" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow">Tutup</button>
        <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Cetak Surat
        </button>
    </div>

    <div class="print-container">
        <!-- KOP SURAT -->
        <div class="border-b-4 border-black pb-4 mb-1 flex items-center gap-6">
            <div class="w-24 h-24 border-2 border-black rounded-full flex items-center justify-center overflow-hidden">
                <img src="{{ asset('images/logoApotek.svg') }}" alt="Logo Apotek Bubulak" style="width:100%;height:100%;object-fit:cover;">
            </div>
            <div class="flex-1 text-center">
                <h1 class="text-3xl font-bold uppercase tracking-wider mb-1">PRAKTIK DOKTER MANDIRI</h1>
                <h2 class="text-2xl font-bold uppercase tracking-widest mb-1">&ldquo;APOTEK BUBULAK&rdquo;</h2>
                <p class="text-sm font-bold">Jl. Bubulak, Bogor, Jawa Barat</p>
                <p class="text-sm">Telp: (0251) 555-1234 | Email: apotek.bubulak@gmail.com | SIP: 123.456.789</p>
            </div>
        </div>
        <div class="border-b border-black mb-8"></div>

        <!-- JUDUL SURAT -->
        <div class="text-center mb-8">
            <h3 class="text-xl font-bold uppercase underline underline-offset-4">Surat Keterangan Sehat</h3>
            <p class="text-md mt-1">Nomor: {{ sprintf("%03d/SKSHT/MEDMAN/%s/%s", rand(100,999), ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'][date('n')-1], date('Y')) }}</p>
        </div>

        <!-- ISI SURAT -->
        <div class="text-justify space-y-4">
            <p>Yang bertanda tangan di bawah ini, Dokter Pemeriksa Apotek Bubulak, menerangkan dengan sesungguhnya bahwa:</p>

            <table class="w-full ml-8 mb-4">
                <tr>
                    <td class="w-40 py-1">Nama Lengkap</td>
                    <td class="w-4 py-1">:</td>
                    <td class="font-bold py-1">{{ $patient->name }}</td>
                </tr>
                <tr>
                    <td class="py-1">Umur</td>
                    <td class="py-1">:</td>
                    <td class="font-bold py-1">{{ \Carbon\Carbon::parse($patient->birth_date)->age }} Tahun</td>
                </tr>
                <tr>
                    <td class="py-1">Jenis Kelamin</td>
                    <td class="py-1">:</td>
                    <td class="font-bold py-1">{{ $patient->gender ?? 'Tidak Disebutkan' }}</td>
                </tr>
                <tr>
                    <td class="py-1">Pekerjaan</td>
                    <td class="py-1">:</td>
                    <td class="font-bold py-1">{{ $patient->occupation ?? 'Tidak Disebutkan' }}</td>
                </tr>
                <tr>
                    <td class="py-1 align-top">Alamat</td>
                    <td class="py-1 align-top">:</td>
                    <td class="font-bold py-1">{{ $patient->address ?? '-' }}</td>
                </tr>
            </table>

            <p>Telah dilakukan pemeriksaan fisik dan kesehatan pada hari ini, dengan hasil sebagai berikut:</p>

            <table class="w-full ml-8 mb-4">
                <tr>
                    <td class="w-40 py-1">Tinggi Badan</td>
                    <td class="w-4 py-1">:</td>
                    <td class="font-bold py-1">{{ $data['tb'] }} cm</td>
                </tr>
                <tr>
                    <td class="py-1">Berat Badan</td>
                    <td class="py-1">:</td>
                    <td class="font-bold py-1">{{ $data['bb'] }} kg</td>
                </tr>
                <tr>
                    <td class="py-1">Tekanan Darah</td>
                    <td class="py-1">:</td>
                    <td class="font-bold py-1">{{ $data['td'] }} mmHg</td>
                </tr>
                <tr>
                    <td class="py-1">Golongan Darah</td>
                    <td class="py-1">:</td>
                    <td class="font-bold py-1">{{ $data['goldar'] }}</td>
                </tr>
                <tr>
                    <td class="py-1">Buta Warna</td>
                    <td class="py-1">:</td>
                    <td class="font-bold py-1">{{ $data['buta_warna'] }}</td>
                </tr>
            </table>

            <p>Berdasarkan hasil pemeriksaan fisik tersebut, pasien di atas dinyatakan dalam keadaan <strong>{{ $data['status_sehat'] }}</strong>.</p>
            
            <p>Surat keterangan ini diberikan untuk keperluan: <strong>{{ $data['keperluan'] }}</strong>.</p>
            
            <p class="mt-4">Demikian surat keterangan sehat ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
        </div>

        <!-- TANDA TANGAN -->
        <div class="flex justify-end mt-16">
            <div class="text-center w-64">
                <p class="mb-20">Bogor, {{ date('d F Y') }}<br>Dokter Pemeriksa,</p>
                <p class="font-bold underline">dr. {{ $doctor->name ?? 'Andini Hurul Aini' }}</p>
                <p>SIP: 123.456.789</p>
            </div>
        </div>
    </div>

    <!-- Auto Print Script -->
    <script>
        window.onload = function() {
            setTimeout(() => {
                window.print();
            }, 500);
        }
    </script>
</body>
</html>
