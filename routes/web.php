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
    
    // Rute untuk Admin
    Route::get('/patients', function() { return view('patients.index'); })->name('patients.index');
    Route::get('/billing', function() { return view('billing.index'); })->name('billing.index');

    // Rute untuk Doctor
    Route::get('/queue', function() { return view('queue.index'); })->name('queue.index');
    Route::get('/medical-records', function() { return view('records.index'); })->name('records.index');
});

require __DIR__.'/auth.php';
