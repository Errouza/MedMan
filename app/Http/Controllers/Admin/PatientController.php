<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Tampilkan daftar rekam medis pasien.
     */
    public function index()
    {
        $patients = \App\Models\Patient::latest()->paginate(10);
        return view('admin.patients.index', compact('patients'));
    }

    /**
     * Form pendaftaran pasien baru.
     */
    public function create()
    {
        return view('admin.patients.create');
    }

    /**
     * Simpan data pasien baru dan generate RM.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'gender' => 'required|in:L,P',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
        ]);

        // Auto-generate No RM (contoh sederhana)
        $validated['medical_record_number'] = 'RM-' . date('Ymd') . '-' . rand(1000, 9999);

        \App\Models\Patient::create($validated);

        return redirect()->route('admin.patients.index')->with('success', 'Pasien berhasil didaftarkan');
    }

    // public function show($id) {...}
    // public function edit($id) {...}
    // public function update(Request $request, $id) {...}
    // public function destroy($id) {...}
}
