<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [EmployeeController::class, 'index']);

Route::resource('employees', EmployeeController::class);
Route::post('/employees/upload-profile', [EmployeeController::class, 'uploadProfile'])->name('employees.uploadProfile');
