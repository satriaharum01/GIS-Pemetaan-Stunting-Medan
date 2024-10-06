<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PuskesmasController;
use App\Http\Controllers\CRUDController;

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
    return redirect('/welcome');
    //return view('welcome');
});

Auth::routes();
//GET PUBLIC
Route::get('/welcome', [CRUDController::class, 'index'])->name('public');

//GET ADMIN
Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
Route::get('/data/kecamatan', [AdminController::class, 'kecamatan'])->name('data.kecamatan');
Route::get('/data/kelurahan', [AdminController::class, 'kelurahan'])->name('data.kelurahan');
Route::get('/data/puskesmas', [AdminController::class, 'puskesmas'])->name('data.puskesmas');
Route::get('/data/users', [AdminController::class, 'data_users'])->name('data.users');
Route::get('/data/register', [AdminController::class, 'data_register'])->name('data.registrasi');
Route::get('/laporan/stunting', [AdminController::class, 'laporan'])->name('laporan.stunting');
Route::get('/laporan/stunting/peta', [AdminController::class, 'peta'])->name('laporan.map');

//GET PUSKESMAS
Route::get('/puskesmas/dashboard', [PuskesmasController::class, 'index'])->name('puskesmas.dashboard');
Route::get('/puskesmas/stunting', [PuskesmasController::class, 'laporan'])->name('puskesmas.stunting');
Route::get('/puskesmas/stunting/peta', [PuskesmasController::class, 'peta'])->name('puskesmas.map');
Route::get('/puskesmas/stunting/json/{tahun}', [PuskesmasController::class, 'json_stunting']);

//JSON
Route::get('/data/kecamatan/json', [CRUDController::class, 'json_kecamatan']);
Route::get('/data/kelurahan/json', [CRUDController::class, 'json_kelurahan']);
Route::get('/data/puskesmas/json', [CRUDController::class, 'json_puskesmas']);
Route::get('/data/users/json', [CRUDController::class, 'json_users']);
Route::get('/data/register/json', [CRUDController::class, 'json_register']);
Route::get('/laporan/stunting/json/{tahun}', [CRUDController::class, 'json_stunting']);

//PATCH
Route::PATCH('/data/kecamatan/update/{id}', [CRUDController::class, 'update_kecamatan']);
Route::PATCH('/data/kelurahan/update/{id}', [CRUDController::class, 'update_kelurahan']);
Route::PATCH('/data/puskesmas/update/{id}', [CRUDController::class, 'update_puskesmas']);
Route::PATCH('/data/users/update/{id}', [CRUDController::class, 'update_users']);
Route::PATCH('/laporan/stunting/update/{id}', [CRUDController::class, 'update_stunting']);

//POST
Route::POST('/data/kecamatan/store', [CRUDController::class, 'store_kecamatan']);
Route::POST('/data/kelurahan/store', [CRUDController::class, 'store_kelurahan']);
Route::POST('/data/puskesmas/store', [CRUDController::class, 'store_puskesmas']);
Route::POST('/data/users/store', [CRUDController::class, 'store_users']);
Route::POST('/data/register/store', [CRUDController::class, 'store_register'])->name('user.register');
Route::POST('/laporan/stunting/store', [CRUDController::class, 'store_stunting']);

//DESTROY
Route::get('/data/kecamatan/delete/{id}', [CRUDController::class, 'destroy_kecamatan']);
Route::get('/data/kelurahan/delete/{id}', [CRUDController::class, 'destroy_kelurahan']);
Route::get('/data/puskesmas/delete/{id}', [CRUDController::class, 'destroy_puskesmas']);
Route::get('/data/users/delete/{id}', [CRUDController::class, 'destroy_users']);
Route::get('/data/register/delete/{id}', [CRUDController::class, 'destroy_register']);
Route::get('/laporan/stunting/delete/{id}', [CRUDController::class, 'destroy_stunting']);

//GETJSON
Route::get('/data/kecamatan/getjson/{id}', [CRUDController::class, 'getjson_kecamatan']);
Route::get('/data/kelurahan/getjson/{id}', [CRUDController::class, 'getjson_kelurahan']);
Route::get('/data/puskesmas/getjson/{id}', [CRUDController::class, 'getjson_puskesmas']);
Route::get('/data/users/getjson/{id}', [CRUDController::class, 'getjson_users']);
Route::get('/data/register/getjson/{id}', [CRUDController::class, 'getjson_register']);
Route::get('/laporan/stunting/getjson/{id}', [CRUDController::class, 'getjson_stunting']);

//Filter
Route::get('/data/puskesmas/filter/{id}', [CRUDController::class, 'getjson_select']);
Route::get('/data/upt/select/{id}', [CRUDController::class, 'getjson_get_laporan']);
Route::get('/data/upt/filter/{id}', [CRUDController::class, 'getjson_filter']);
Route::get('/data/laporan/filter/getyear', [CRUDController::class, 'get_year_laporan']);
//Route::get('/data/laporan/patch/{id}/{start}/{end}', [CRUDController::class, 'patching']);
//Route::get('/data/laporan/newpatch/', [CRUDController::class, 'new_patching']);

//MAP
Route::get('/laporan/map/json/{id}', [CRUDController::class, 'json_map']);
Route::get('/puskesmas/map/json/{id}', [PuskesmasController::class, 'json_map']);
Route::get('/test/{id}', [AdminController::class, 'graph_pus']);

//Laporan Puskesmas
Route::get('/data/laporan/cetak', [AdminController::class, 'cetak_stunting']);