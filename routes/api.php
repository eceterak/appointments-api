<?php
Route::post('/user', 'AuthController@register');

// Route::middleware('auth.jwt')->group(function() {
//     Route::apiResource('/doctors', 'DoctorsController');
//     Route::apiResource('/departments', 'DepartmentsController');
//     Route::post('/images', 'ImagesController@store');
//     Route::delete('/images/{image}', 'ImagesController@destroy');
// });

Route::group([], function() {
    Route::post('/login', 'AuthController@login');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
    Route::post('/me', 'AuthController@me');
});

Route::apiResource('/doctors', 'DoctorsController');
Route::apiResource('/patients', 'PatientsController');
Route::apiResource('/departments', 'DepartmentsController');

Route::get('/departments/{department}/doctors', 'DepartmentsController@doctors');

Route::post('/images', 'ImagesController@store');
Route::delete('/images/{image}', 'ImagesController@destroy');
