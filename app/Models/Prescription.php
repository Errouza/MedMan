<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = ['patient_id', 'status'];
    
    public function items()
    {
        return $this->hasMany(PrescriptionItem::class);
    }
}
