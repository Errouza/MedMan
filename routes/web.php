<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rute untuk Admin & Dokter (Pasien)
    Route::get('/patients', function() { 
        $patients = \App\Models\Patient::latest()->get();
        return view('patients.index', compact('patients')); 
    })->name('patients.index');

    Route::post('/patients', function(\Illuminate\Http\Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:patients,nik',
            'phone' => 'required|string|min:10',
            'gejala' => 'nullable|string|max:1000',
            'tindakan' => 'nullable|string|max:1000',
        ]);

        \App\Models\Patient::create([
            'medical_record_number' => 'RM' . date('YmdHis'),
            'name' => $request->name,
            'nik' => $request->nik,
            'phone' => $request->phone,
            'gejala' => $request->gejala,
            'tindakan' => $request->tindakan,
        ]);

        return back()->with('success', 'Data Pasien ' . $request->name . ' Berhasil Disimpan!');
    })->name('patients.store');
    
    Route::get('/billing', function() { return view('billing.index'); })->name('billing.index');
    Route::get('/stock', function() { return view('stock.index'); })->name('stock.index');

    // Rute untuk Doctor
    Route::get('/queue', function() { 
        $patients = \App\Models\Patient::latest()->get();
        return view('queue.index', compact('patients')); 
    })->name('queue.index');
    Route::get('/medical-records', function() { return view('records.index'); })->name('records.index');
});

require __DIR__.'/auth.php';
