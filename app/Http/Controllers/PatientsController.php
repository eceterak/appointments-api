<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Filters\PatientFilters;
use App\Http\Resources\PatientCollection as PatientResourceCollection;
use App\Http\Resources\Patient as PatientResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Responsei
     */
    public function index(Request $request, PatientFilters $filters) 
    {    
        if($request->clean) 
        {
            return new PatientResourceCollection(Patient::all());
        }

        return new PatientResourceCollection(
            Patient::filter($filters)->paginate()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient) 
    {
        return new PatientResource($patient);
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
            'phone' => ['required'],
            'dateOfBirth' => ['required']
        ])->validate();

        $patient = Patient::create([
            'name' => $request->name, 
            'surname' => $request->surname,
            'title' => $request->title,
            'phone' => $request->phone,
            'date_of_birth' => $request->dateOfBirth
        ]);

        return new PatientResource($patient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient) 
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'surname' => ['required'],
            'title' => ['required'],
            'phone' => ['required'],
            'dateOfBirth' => ['required']
        ])->validate();

        $patient->update([
            'name' => $request->name, 
            'surname' => $request->surname,
            'title' => $request->title,
            'phone' => $request->phone,
            'date_of_birth' => $request->dateOfBirth
        ]);

        return new PatientResource($patient);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient) 
    {
        return response()->json($patient->delete(), 200);
    }
}
