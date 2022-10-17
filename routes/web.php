<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
// use App\Htpp\Contollers\EmployeeController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/employees',[EmployeeController::class, 'index'])->name('employees.index');
// Route::get('/employees/create',[EmployeeController::class, 'create'])->name('employees.create');
// Route::post('/employees/store',[EmployeeController::class, 'store'])->name('employees.store');
// Route::get('/employees/{employee}/edit',[EmployeeController::class, 'edit'])->name('employees.edit');
// Route::put('/employees/{employee}',[EmployeeController::class, 'update'])->name('employees.update');
// Route::delete('/employees',[EmployeeController::class, 'destroy'])->name('employees.destroy');


Route::resource('employees', EmployeeController::class);