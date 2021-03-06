<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/verify-phone', 'PhoneVerificationController@show')->name('phone.verify.show');
Route::post('/verify-phone', 'PhoneVerificationController@verify')->name('phone.verify.submit');
Route::post('/verify-phone/resend', 'PhoneVerificationController@resend')->name('phone.verify.resend');

Route::group(['prefix' => 'doctor'], function () {
    Route::get('/patient/{patient}', 'Doctor\PatientController@show');
    Route::get('/patient/{patient}/new-records', 'Doctor\PatientController@newRecords');
    Route::post('/add-patient', 'Doctor\PatientController@addPatient');
});

Route::group(['prefix' => 'patient'], function () {
    Route::get('/doctor/{doctor}', 'Patient\DoctorController@show');
    Route::post('/record', 'Patient\RecordController@store');
    Route::get('/pending-request', 'Patient\RequestController@pendingRequest');
    Route::put('/request/accept', 'Patient\RequestController@accept');
    Route::put('/request/decline', 'Patient\RequestController@decline');
});
