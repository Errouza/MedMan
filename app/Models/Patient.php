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
        'address',
        'phone',
        'gejala',
        'tindakan',
    ];
}
