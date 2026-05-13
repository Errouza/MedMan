<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (Auth::user()->role === 'doctor') {
        return redirect()->route('patients.index');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/notes', function(\Illuminate\Http\Request $request) {
        $request->validate(['content' => 'required|string']);
        \App\Models\Note::create([
            'content' => $request->content,
            'deadline' => $request->deadline,
        ]);
        return back()->with('success', 'Catatan berhasil ditambahkan!');
    })->name('notes.store');

    Route::delete('/notes/{note}', function(\App\Models\Note $note) {
        $note->delete();
        return back()->with('success', 'Catatan berhasil dihapus!');
    })->name('notes.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rute untuk Admin & Dokter (Shared tapi berbeda logika di dalam)
    Route::get('/patients', function(\Illuminate\Http\Request $request) { 
        $query = \App\Models\Patient::query();
        $searchPerformed = false;
        
        if (Auth::user()->role === 'admin') {
            if ($request->filled('search_name') || $request->filled('search_nik')) {
                $searchPerformed = true;
                if ($request->filled('search_name')) {
                    $query->where('name', 'like', '%' . $request->search_name . '%');
                }
                if ($request->filled('search_nik')) {
                    $query->where('nik', $request->search_nik);
                }
            }
        } else {
            $query->whereDate('created_at', \Carbon\Carbon::today())
                  ->whereIn('status', ['waiting', 'in_progress']);
        }
        
        $patients = $query->latest()->get();
        return view('patients.index', compact('patients', 'searchPerformed')); 
    })->name('patients.index');

    Route::get('/patients/{patient}', function(\App\Models\Patient $patient) {
        $histories = \App\Models\MedicalHistory::where('patient_id', $patient->patient_id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('patients.show', compact('patient', 'histories'));
    })->name('patients.show');

    // ==========================================
    // RUTE KHUSUS DOKTER
    // ==========================================
    Route::patch('/patients/{patient}/status', function(\Illuminate\Http\Request $request, \App\Models\Patient $patient) {
        if (Auth::user()->role !== 'doctor') abort(403, 'Akses ditolak. Khusus Dokter.');
        $request->validate(['status' => 'required|in:waiting,in_progress,checked,completed']);
        $patient->update(['status' => $request->status]);
        
        if ($request->status === 'in_progress') {
            return redirect()->route('patients.diagnose', $patient);
        }
        return back()->with('success', 'Status pasien berhasil diperbarui!');
    })->name('patients.update_status');

    Route::get('/patients/{patient}/diagnose', function(\App\Models\Patient $patient) {
        if (Auth::user()->role !== 'doctor') abort(403, 'Akses ditolak. Khusus Dokter.');
        if ($patient->status !== 'in_progress') {
            return redirect()->route('patients.index')->with('error', 'Pasien belum atau sudah diperiksa.');
        }
        return view('patients.diagnose', compact('patient'));
    })->name('patients.diagnose');

    Route::patch('/patients/{patient}/diagnose', function(\Illuminate\Http\Request $request, \App\Models\Patient $patient) {
        if (Auth::user()->role !== 'doctor') abort(403, 'Akses ditolak. Khusus Dokter.');
        $request->validate([
            'gejala' => 'required|string',
            'diagnosa' => 'required|string',
            'tindakan' => 'required|string',
            'harga' => 'required|numeric|min:0',
        ]);
        
        $patient->update([
            'gejala' => $request->gejala,
            'diagnosa' => $request->diagnosa,
            'tindakan' => $request->tindakan,
            'harga' => $request->harga,
            'status' => 'checked',
        ]);

        if ($request->has('resep_obat') && is_array($request->resep_obat) && count($request->resep_obat) > 0 && !empty($request->resep_obat[0])) {
            $prescription = \App\Models\Prescription::create([
                'patient_id' => $patient->patient_id,
                'status' => 'pending'
            ]);
            
            foreach ($request->resep_obat as $index => $medicineName) {
                if (empty($medicineName)) continue;
                
                $medicine = \App\Models\Medicine::firstOrCreate(
                    ['name' => $medicineName],
                    ['stock' => 50, 'price' => 15000]
                );
                
                \App\Models\PrescriptionItem::create([
                    'prescription_id' => $prescription->id,
                    'medicine_id' => $medicine->id,
                    'dosis' => $request->resep_dosis[$index] ?? '-',
                    'keterangan' => $request->resep_keterangan[$index] ?? '',
                    'jumlah' => $request->resep_jumlah[$index] ?? 1,
                ]);
            }
        }
        
        return redirect()->route('patients.index')->with('success', 'Pemeriksaan dan resep obat pasien berhasil disimpan!');
    })->name('patients.diagnose.update');

    Route::get('/pelayanan', function() {
        if (Auth::user()->role !== 'doctor') abort(403, 'Akses ditolak. Khusus Dokter.');
        $patient = \App\Models\Patient::where('status', 'in_progress')->whereDate('created_at', \Carbon\Carbon::today())->first();
        if ($patient) {
            return redirect()->route('patients.diagnose', $patient);
        }
        return redirect()->route('patients.index')->with('error', 'Pilih pasien dari antrean terlebih dahulu dengan mengklik "Terima Pasien".');
    })->name('pelayanan.index');

    Route::get('/prescriptions', function() {
        if (Auth::user()->role !== 'doctor') abort(403, 'Akses ditolak. Khusus Dokter.');
        $patients = \App\Models\Patient::whereIn('status', ['waiting', 'in_progress', 'checked'])->get();
        return view('prescriptions.index', compact('patients'));
    })->name('prescriptions.index');

    Route::post('/prescriptions', function(\Illuminate\Http\Request $request) {
        if (Auth::user()->role !== 'doctor') abort(403, 'Akses ditolak. Khusus Dokter.');
        return back()->with('success', 'Resep berhasil dibuat dan ditandatangani!');
    })->name('prescriptions.store');

    Route::get('/certificates', function() {
        if (Auth::user()->role !== 'doctor') abort(403, 'Akses ditolak. Khusus Dokter.');
        $patients = \App\Models\Patient::whereIn('status', ['waiting', 'in_progress', 'checked'])->get();
        return view('certificates.index', compact('patients'));
    })->name('certificates.index');

    Route::post('/certificates', function(\Illuminate\Http\Request $request) {
        if (Auth::user()->role !== 'doctor') abort(403, 'Akses ditolak. Khusus Dokter.');
        $request->validate([
            'patient_id' => 'required|exists:patients,patient_id',
            'type' => 'required|in:sekolah,kerja',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:255',
        ]);

        $count = \App\Models\Certificate::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->count() + 1;
        $monthRoman = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'][date('n') - 1];
        $typeCode = $request->type == 'sekolah' ? 'SKS' : 'SKK';
        $certNum = sprintf("%03d/%s/MEDMAN/%s/%s", $count, $typeCode, $monthRoman, date('Y'));

        \App\Models\Certificate::create(array_merge($request->all(), [
            'certificate_number' => $certNum
        ]));

        return back()->with('success', 'Surat Keterangan Sakit berhasil dibuat!');
    })->name('certificates.store');

    Route::get('/medical-records', function() { 
        if (Auth::user()->role !== 'doctor') abort(403, 'Akses ditolak. Khusus Dokter.');
        return view('records.index'); 
    })->name('records.index');

    // ==========================================
    // RUTE KHUSUS ADMIN
    // ==========================================
    Route::get('/queue', function() { 
        if (Auth::user()->role !== 'admin') abort(403, 'Akses ditolak. Khusus Administrator.');
        $patients = \App\Models\Patient::latest()->get();
        return view('queue.index', compact('patients')); 
    })->name('queue.index');

    Route::post('/patients', function(\Illuminate\Http\Request $request) {
        if (Auth::user()->role !== 'admin') abort(403, 'Akses ditolak. Khusus Administrator.');
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:patients,nik',
            'phone' => 'required|string|min:10',
            'address' => 'nullable|string|max:500',
            'birth_date' => 'nullable|date',
            'gejala' => 'nullable|string|max:1000',
            'tindakan' => 'nullable|string|max:1000',
        ]);

        \App\Models\Patient::create([
            'medical_record_number' => 'RM' . date('YmdHis'),
            'name' => $request->name,
            'nik' => $request->nik,
            'phone' => $request->phone,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'gejala' => $request->gejala,
            'tindakan' => $request->tindakan,
            'status' => 'waiting',
        ]);

        return back()->with('success', 'Data Pasien ' . $request->name . ' Berhasil Disimpan!');
    })->name('patients.store');

    Route::post('/patients/{patient}/new-visit', function(\App\Models\Patient $patient) {
        if (Auth::user()->role !== 'admin') abort(403, 'Akses ditolak. Khusus Administrator.');
        if ($patient->status === 'waiting' || $patient->status === 'in_progress' || $patient->status === 'checked') {
            return back()->with('error', 'Pasien ini masih dalam antrean aktif!');
        }

        $patient->update([
            'status' => 'waiting',
            'gejala' => null,
            'tindakan' => null,
            'diagnosa' => null,
            'harga' => null,
            'created_at' => now(), 
        ]);

        return redirect()->route('dashboard')->with('success', 'Kunjungan baru untuk pasien ' . $patient->name . ' berhasil dibuat dan masuk antrean!');
    })->name('patients.new_visit');

    Route::get('/billing', function() { 
        if (Auth::user()->role !== 'admin') abort(403, 'Akses ditolak. Khusus Administrator.');
        return view('billing.index'); 
    })->name('billing.index');

    Route::get('/billing/{patient}', function(\App\Models\Patient $patient) {
        if (Auth::user()->role !== 'admin') abort(403, 'Akses ditolak. Khusus Administrator.');
        if ($patient->status !== 'checked' && $patient->status !== 'completed') {
            return redirect()->route('dashboard')->with('error', 'Pasien belum selesai diperiksa.');
        }
        
        $prescriptions = \App\Models\Prescription::where('patient_id', $patient->patient_id)
            ->where('status', 'pending')
            ->with('items.medicine')
            ->first();

        return view('billing.index', compact('patient', 'prescriptions'));
    })->name('billing.show');

    Route::post('/billing/{patient}', function(\Illuminate\Http\Request $request, \App\Models\Patient $patient) {
        if (Auth::user()->role !== 'admin') abort(403, 'Akses ditolak. Khusus Administrator.');
        $prescriptions = \App\Models\Prescription::where('patient_id', $patient->patient_id)
            ->where('status', 'pending')
            ->first();
            
        $prescriptionData = null;
        if ($prescriptions) {
            $prescriptionData = [];
            foreach($prescriptions->items as $item) {
                $medicine = $item->medicine;
                if ($medicine) {
                    $prescriptionData[] = [
                        'name' => $medicine->name,
                        'jumlah' => $item->jumlah,
                        'harga' => $item->harga
                    ];
                    $medicine->decrement('stock', $item->jumlah);
                }
            }
            $prescriptions->update(['status' => 'dispensed']);
        }

        \App\Models\MedicalHistory::create([
            'patient_id' => $patient->patient_id,
            'gejala' => $patient->gejala,
            'diagnosa' => $patient->diagnosa,
            'tindakan' => $patient->tindakan,
            'harga' => $patient->harga,
            'prescription_data' => $prescriptionData,
            'created_at' => $patient->updated_at ?? now(), 
        ]);

        $patient->update([
            'status' => 'completed'
        ]);

        return redirect()->route('dashboard')->with('success', 'Pembayaran pasien berhasil diselesaikan!');
    })->name('billing.store');

    Route::get('/stock', function() { 
        if (Auth::user()->role !== 'admin') abort(403, 'Akses ditolak. Khusus Administrator.');
        return view('stock.index'); 
    })->name('stock.index');

});

require __DIR__.'/auth.php';
