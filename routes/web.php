<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\LoginController;
use App\Models\Departamento;

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
    //return view('welcome');
    return view('admin.home');
})->middleware('sesion');

Route::resource('departamento', DepartamentoController::class)->middleware('sesion');
Route::resource('empleado', EmpleadoController::class)->middleware('sesion');
Route::resource('puesto', PuestoController::class)->middleware('sesion');
Route::get('login', [LoginController::class,'showLogin']);
Route::post('login', [LoginController::class, 'login']);
route::get('puesto/search/{busqueda}', [PuestoController::class, 'search']);
route::get('departamento/search/{busqueda}', [DepartamentoController::class, 'search']);
route::get('empleado/search/{busqueda}', [EmpleadoController::class, 'search']);
Route::fallback(function(){
    return view('admin.404');
});
Route::post('puesto/transferencia/{id}', [PuestoController::class, 'transferencia']);
Route::post('departamento/transferencia/{id}', [DepartamentoController::class, 'transferencia']);