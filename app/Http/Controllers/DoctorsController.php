<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Doctor;
use App\Filters\DoctorFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\Doctor as DoctorResource;
use App\Http\Resources\DoctorCollection as DoctorResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DoctorFilters $filters) 
    {    
        return new DoctorResourceCollection(
            Doctor::filter($filters)->paginate(10)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Doctor  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor) 
    {
        return new DoctorResource($doctor->load('Images'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'surname' => ['required'],
            'title' => ['required'],
            'deparment.*.id' => ['required']
        ])->validate();

        $doctor = Doctor::create([
            'name' => $request->name, 
            'surname' => $request->surname,
            'title' => $request->title,
            'department_id' => $request->input('department.id')
        ]);

        return new DoctorResource($doctor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor) 
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'surname' => ['required'],
            'title' => ['required'],
            'deparment.*.id' => ['required']
        ])->validate();

        $doctor->update([
            'name' => $request->name, 
            'surname' => $request->surname,
            'title' => $request->title,
            'department_id' => $request->input('department.id')
        ]);

        return new DoctorResource($doctor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor) 
    {
        return response()->json($doctor->delete(), 200);
    }

    /**
     * Return all services of given department.
     *
     * @return \Illuminate\Http\Response
     */
    public function appointments(Doctor $doctor, Request $request)
    {
        $date = $request->date;
        $fiveDaysFrom = date('Y-m-d', strtotime($date.' + 5 days'));

        $appointments = Appointment::where('doctor_id', $doctor->id)->whereBetween('date',  [Date($date), Date($fiveDaysFrom)])->get()->groupBy('date');

        return response()->json(['data' => $appointments], 200);
    }
}
