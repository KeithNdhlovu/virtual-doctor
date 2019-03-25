<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    const TYPE_WAITING   = 1;
    const TYPE_APPROVED  = 2;
    const TYPE_FINISHED  = 3;
    const TYPE_CANCELLED = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'notes',
        'status',
        'patient_id',
        'doctor_id',
        'date_approved',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
