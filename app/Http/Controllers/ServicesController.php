<?php

namespace App\Http\Controllers;

use App\Http\Resources\DoctorCollection as DoctorCollectionResource;
use App\Http\Resources\Service as ServiceResource;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new DoctorCollectionResource(
            Service::paginate()
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
        Validator::make($request->all(), [
            'name' => ['required'],
            'description' => ['required'],
            'deparment.*.id' => ['required']
        ])->validate();

        $service = Service::create([
            'name' => $request->name, 
            'description' => $request->description,
            'department_id' => $request->input('department.id')
        ]);

        return new ServiceResource($service);
    }

    /**
     * Display the specified resource.
     *
     * @param  Service $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return new ServiceResource($service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Service $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'description' => ['required'],
            'deparment.*.id' => ['required']
        ])->validate();

        $service = Service::update([
            'name' => $request->name, 
            'descritpion' => $request->descritpion,
            'department_id' => $request->input('department.id')
        ]);

        return new ServiceResource($service);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Service $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        return response()->json($service->delete(), 200);
    }
}
