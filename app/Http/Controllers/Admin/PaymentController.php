<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Tampilkan data pembayaran yang belum dan sudah lunas
     */
    public function index()
    {
        $payments = \App\Models\Payment::with(['visit.patient'])
            ->latest()
            ->paginate(10);

        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Tampilkan form proses / rincian tagihan
     */
    public function show(\App\Models\Payment $payment)
    {
        $payment->load(['visit.patient', 'visit.medicalRecord.medicalTreatments']);
        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Proses pembayaran (Kasir)
     */
    public function update(Request $request, \App\Models\Payment $payment)
    {
        $validated = $request->validate([
            'payment_method' => 'required|string',
            'amount_paid' => 'required|numeric'
        ]);

        if ($validated['amount_paid'] < $payment->total_amount) {
            return back()->with('error', 'Jumlah pembayaran kurang dari total tagihan.');
        }

        $payment->update([
            'status' => 'paid',
            'payment_method' => $validated['payment_method'],
            'paid_at' => now()
        ]);

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }
}
