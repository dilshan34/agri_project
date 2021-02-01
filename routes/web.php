<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [Home::class, "FormEmployee"]);
Route::get('employees', [Home::class, "GetEmployees"]);
Route::post('employees', [Home::class, "AddEmployee"]);
Route::get('male', [Home::class, "GetMaleEmployees"]);
Route::get('female', [Home::class, "GetFemaleEmployees"]);
Route::get('delete/{id}',[Home::class, "DeleteEmployees"]);