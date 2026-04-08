<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    /**
     * Form pemeriksaan pasien (pengisian RM)
     */
    public function create(\App\Models\Visit $visit)
    {
        // Pastikan kunjungan masih bisa diperiksa
        if ($visit->status !== 'in_progress') {
            return redirect()->route('doctor.queue.index')->with('error', 'Pasien belum dipanggil.');
        }

        return view('doctor.medical_records.create', compact('visit'));
    }

    /**
     * Simpan hasil pemeriksaan & tindakan medis
     */
    public function store(Request $request, \App\Models\Visit $visit)
    {
        $validated = $request->validate([
            'anamnesis' => 'nullable|string',
            'physical_examination' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'notes' => 'nullable|string',
            'treatments' => 'nullable|array', // array tindakan medis
            'treatments.*.name' => 'required|string',
            'treatments.*.cost' => 'required|numeric'
        ]);

        \Illuminate\Support\Facades\DB::transaction(function () use ($validated, $visit) {
            // 1. Simpan Rekam Medis
            $medicalRecord = \App\Models\MedicalRecord::create([
                'visit_id' => $visit->id,
                'anamnesis' => $validated['anamnesis'],
                'physical_examination' => $validated['physical_examination'],
                'diagnosis' => $validated['diagnosis'],
                'notes' => $validated['notes'],
            ]);

            // 2. Simpan Tindakan (jika ada)
            if (!empty($validated['treatments'])) {
                foreach ($validated['treatments'] as $t) {
                    \App\Models\MedicalTreatment::create([
                        'medical_record_id' => $medicalRecord->id,
                        'treatment_name' => $t['name'],
                        'cost' => $t['cost']
                    ]);
                }
            }

            // 3. Update Status Visit -> Completed
            $visit->update(['status' => 'completed']);

            // 4. (Opsional) Buat entri tagihan (Payment) otomatis
            \App\Models\Payment::create([
                'visit_id' => $visit->id,
                'total_amount' => collect($validated['treatments'] ?? [])->sum('cost'),
                'status' => 'unpaid'
            ]);
        });

        return redirect()->route('doctor.queue.index')->with('success', 'Pemeriksaan selesai!');
    }
}
