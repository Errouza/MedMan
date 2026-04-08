<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    /**
     * Tampilkan daftar antrean hari ini
     */
    public function index()
    {
        $visits = \App\Models\Visit::with(['patient', 'doctor'])
            ->whereDate('visit_date', date('Y-m-d'))
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.visits.index', compact('visits'));
    }

    /**
     * Form pendaftaran antrean kunjungan
     */
    public function create()
    {
        $patients = \App\Models\Patient::all();
        $doctors = \App\Models\User::where('role', 'doctor')->get();
        return view('admin.visits.create', compact('patients', 'doctors'));
    }

    /**
     * Simpan pendaftaran kunjungan
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:users,id',
            'complaint' => 'required|string'
        ]);

        $validated['visit_date'] = now();
        $validated['status'] = 'waiting';

        \App\Models\Visit::create($validated);

        return redirect()->route('admin.visits.index')->with('success', 'Antrean berhasil ditambahkan');
    }
}
