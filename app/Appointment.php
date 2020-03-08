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
        'department_id', 
        'appointment_type_id', 
        'patient_id', 
        'date', 
        'time'
    ];
}
