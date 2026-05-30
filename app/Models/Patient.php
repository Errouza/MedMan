<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $primaryKey = 'patient_id';
    
    protected $fillable = [
        'medical_record_number',
        'nik',
        'name',
        'birth_date',
        'gender',
        'occupation',
        'address',
        'phone',
        'gejala',
        'diagnosa',
        'tindakan',
        'harga',
        'status',
    ];

    /**
     * Get the chronological queue number for this patient on their registration date.
     */
    public function getQueueNumberAttribute()
    {
        if (!$this->created_at) {
            return null;
        }
        
        return self::whereDate('created_at', $this->created_at->toDateString())
            ->where(function($query) {
                $query->where('created_at', '<', $this->created_at)
                      ->orWhere(function($q) {
                          $q->where('created_at', '=', $this->created_at)
                            ->where('patient_id', '<=', $this->patient_id);
                      });
            })
            ->count();
    }
}
