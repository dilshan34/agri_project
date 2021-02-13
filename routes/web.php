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
*/

Route::get('/user', function () { return view('user.welcome'); });

Route::group(['middleware' => ['auth']] ,function()
{
       Route::get('/dashboard','App\Http\Controllers\DashboardController@index')->name ('dashboard');

});


require __DIR__.'/auth.php';


//Route::get('/', [Home::class, "FormEmployee"]);



Route::get('employees', [Home::class, "GetEmployees"]);
Route::post('employees', [Home::class, "AddEmployee"]);
Route::get('male', [Home::class, "GetMaleEmployees"]);
Route::get('female', [Home::class, "GetFemaleEmployees"]);
Route::get('delete/{id}',[Home::class, "DeleteEmployees"]);
Route::get('edit/{id}',[Home::class, "EditEmployee"]);
Route::post('edit',[Home::class, "Update"]);

Route::get('crops',[Home::class, "CropsInfo"]);
Route::post('addCategory',[Home::class, "AddCrop"]);
Route::get('deletecrop/{id}',[Home::class, "DeleteCrop"]);

Route::post('inflow',[Home::class, "HarvestInflow"]);
Route::post('outflow',[Home::class, "HarvestOutflow"]);
Route::get('deleteinflow/{id}',[Home::class, "DeleteInflow"]);
Route::get('deleteoutflow/{id}',[Home::class, "DeleteOutflow"]);
Route::get('editinflow/{id}',[Home::class, "EditInflow"]);
Route::get('editoutflow/{id}',[Home::class, "EditOutflow"]);
Route::post('updateinflow',[Home::class, "UpdateHarvestInflow"]);
Route::post('updateoutflow',[Home::class, "UpdateHarvestOutflow"]);

Route::get('income',[Home::class, "CropsIncome"]);
Route::get('expence',[Home::class, "CropsExpence"]);
Route::post('income',[Home::class, "AddCropsIncome"]);
Route::post('expence',[Home::class, "AddCropsExpence"]);
Route::get('editincome/{id}',[Home::class, "EditIncome"]);
Route::get('editexpence/{id}',[Home::class, "EditExpence"]);
Route::get('deleteincome/{id}',[Home::class, "DeleteIncome"]);
Route::get('deleteexpence/{id}',[Home::class, "DeleteExpence"]);
Route::post('updateincome',[Home::class, "UpdateCropsIncome"]);
Route::post('updateexpence',[Home::class, "UpdateCropsExpence"]);
