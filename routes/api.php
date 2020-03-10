<?php
Route::post('/user', 'AuthController@register');

Route::middleware('auth.jwt')->group(function() {
    Route::apiResource('/doctors', 'DoctorsController');
    Route::apiResource('/patients', 'PatientsController');
    Route::apiResource('/departments', 'DepartmentsController');
    Route::apiResource('/appointments', 'AppointmentsController');
    Route::apiResource('/services', 'ServicesController');
    
    Route::get('/departments/{department}/doctors', 'DepartmentsController@doctors');
    Route::get('/departments/{department}/services', 'DepartmentsController@services');
    Route::get('/doctors/{doctor}/appointments', 'DoctorsController@appointments');
    
    Route::post('/images', 'ImagesController@store');
    Route::delete('/images/{image}', 'ImagesController@destroy');
});

Route::group([], function() {
    Route::post('/login', 'AuthController@login');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
    Route::post('/me', 'AuthController@me');
});