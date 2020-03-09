<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Http\Resources\Appointment as AppointmentResource;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        return new AppointmentResource($appointment);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $appointment = Appointment::create($request->validate([
            'doctor_id' => 'required',
            'patient_id' => 'required',
            'service_id' => 'required',
            'slot' => 'required',
            'date' => 'required'
        ]));

        return new AppointmentResource($appointment);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Appointment  $appointment
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Appointment $appointment, Request $request)
    {
        $appointment->update($request->validate([
            'doctor_id' => 'required',
            'patient_id' => 'required',
            'service_id' => 'required',
            'slot' => 'required',
            'date' => 'required'
        ]));

        return new AppointmentResource($appointment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        return response()->json($appointment->delete(), 200);
    }
}
