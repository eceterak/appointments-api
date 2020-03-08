<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Department;
use App\Doctor;
use App\Http\Resources\DepartmentCollection;
use App\Http\Resources\Department as DepartmentResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->clean) 
        {
            return new DepartmentCollection(Department::all());
        }
        
        return new DepartmentCollection(
            Department::paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $department = Department::create($request->validate([
            'name' => 'required'
        ]));

        return new DepartmentResource($department);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return new DepartmentResource($department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        Validator::make($request->all(), [
            'name' => [
                'required', Rule::unique('departments')->ignore($department->id)
            ]
        ])->validate();

        $department->update($request->all());

        return new DepartmentResource($department);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        return response()->json($department->delete(), 200);
    }

    /**
     * Return all doctors of given department.
     *
     * @return \Illuminate\Http\Response
     */
    public function doctors(Department $department)
    {
        return response()->json([
            'data' => $department->doctors
        ], 200);
    }
}
