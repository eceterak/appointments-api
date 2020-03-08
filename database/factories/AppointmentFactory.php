<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Appointment;
use Faker\Generator as Faker;

$factory->define(Appointment::class, function (Faker $faker) {
    return [
        'doctor_id' => 1,
        'department_id' => 3,
        'appointment_type_id' => 1,
        'patient_id' => 1,
        'date' => date('Y-m-d'),
        'time' => '10:00'
    ];
});
