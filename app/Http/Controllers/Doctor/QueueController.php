<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    /**
     * Tampilkan antrean pasien untuk dokter yang sedang login
     */
    public function index()
    {
        $doctorId = auth()->id(); // dokter saat ini
        
        $queue = \App\Models\Visit::with('patient')
            ->where('doctor_id', $doctorId)
            ->whereIn('status', ['waiting', 'in_progress'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('doctor.queue.index', compact('queue'));
    }

    /**
     * Panggil pasien (ubah status waiting -> in_progress)
     */
    public function callPatient(\App\Models\Visit $visit)
    {
        if ($visit->status === 'waiting') {
            $visit->update(['status' => 'in_progress']);
        }

        // Arahkan ke halaman pengisian rekam medis
        return redirect()->route('doctor.medical-records.create', $visit);
    }
}
