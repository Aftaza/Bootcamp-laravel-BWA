<?php

use App\Http\Controllers\Backsite\ConfigPaymentController;
use App\Http\Controllers\Backsite\ConsultationController;
use Illuminate\Support\Facades\Route;

// backsite 
use App\Http\Controllers\Backsite\DashboardController;
use App\Http\Controllers\Backsite\DoctorController;
use App\Http\Controllers\Backsite\HospitalPatientController;
use App\Http\Controllers\Backsite\PermissionController;
use App\Http\Controllers\Backsite\ReportAppointmentController;
use App\Http\Controllers\Backsite\ReportTransactionController;
use App\Http\Controllers\Backsite\RoleController;
use App\Http\Controllers\Backsite\SpecialistController;
use App\Http\Controllers\Backsite\TypeUserController;
use App\Http\Controllers\Backsite\UserController;
//frontsite
use App\Http\Controllers\Frontsite\LandingController;
use App\Http\Controllers\Frontsite\AppointmentController;
use App\Http\Controllers\Frontsite\PaymentController;

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

Route::resource('/', LandingController::class);

// frontsite routes
Route::group(['middleware' => ['auth:sanctum', 'verified']], function(){
    // appointment page
    Route::resource('appointment', AppointmentController::class);
    // payment page
    Route::resource('payment', PaymentController::class);
});

// backsite routes
Route::group(['prefix' => 'backsite', 'as' => 'backsite.', 'middleware' => ['auth:sanctum', 'verified']], function(){
    // dashboard route
    Route::resource('dashboard', DashboardController::class);

    // permission route
    Route::resource('permission', PermissionController::class);

    // role route
    Route::resource('role', RoleController::class);

    // user route
    Route::resource('user', UserController::class);

    // type user route
    Route::resource('type_user', TypeUserController::class);

    // consultation route
    Route::resource('consultation', ConsultationController::class);

    // specialist route
    Route::resource('specialist', SpecialistController::class);

    // config payment route
    Route::resource('config_payment', ConfigPaymentController::class);

    // doctor route
    Route::resource('doctor', DoctorController::class);

    // hospital patient
    Route::resource('hospital_patient', HospitalPatientController::class);

    // report routes
    
    // appointment route
    Route::resource('appointment', ReportAppointmentController::class);
    // transaction route
    Route::resource('transaction', ReportTransactionController::class);


});

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
