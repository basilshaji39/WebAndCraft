<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;



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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[EmployeeController::class,'index']);
Route::get('/emp-listing',[EmployeeController::class,'getEmployee'])->name('employee.list');
Route::get('/emp-Datatable',[EmployeeController::class,'getEmployee']);
Route::post('/employee', [EmployeeController::class, 'store']);
Route::get('/employee/{id}/edit', [EmployeeController::class, 'edit']);
Route::put('/employee/{id}', [EmployeeController::class, 'update']);
Route::delete('/employee/{id}', [EmployeeController::class, 'destroy']);



