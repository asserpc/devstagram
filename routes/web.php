<?php

use App\Http\Controllers\Registercontroller;
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

Route::get('/', function () {
    return view('inicio');
});
Route::get('/register',[Registercontroller::class,'index'])->name('register');
Route::post('/register',[Registercontroller::class,'store']);