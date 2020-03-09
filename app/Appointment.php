<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /**
     * @var Array
     */
    protected $fillable = [
        'doctor_id', 
        'patient_id', 
        'service_id', 
        'slot',
        'date'
    ];

    /**
     * @var Array
     */
    protected $with = [
        'doctor', 'patient', 'service'
    ];

    /**
     * belongsTo(Doctor)
     */
    public function doctor() 
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * belongsTo(Patient)
     */
    public function patient() 
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * belongsTo(Service)
     */
    public function service() 
    {
        return $this->belongsTo(Service::class);
    }
}
