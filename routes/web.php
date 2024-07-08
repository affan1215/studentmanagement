<?php

use App\Http\Controllers\ResultController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('student', [StudentController::class, 'index']);
    Route::post('savedata', [StudentController::class, 'savedata']);
    Route::get('getdata', [StudentController::class, 'getdata']);
    Route::post('editdata', [StudentController::class, 'editdata']);
    Route::post('deletedata', [StudentController::class, 'deletedata']);
    Route::resource('result', ResultController::class);
    Route::get('getStudentDetails/{id}', [ResultController::class, 'getStudentDetails']);
});
