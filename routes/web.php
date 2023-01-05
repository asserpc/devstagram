<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Registercontroller;
use Illuminate\Routing\Route as RoutingRoute;

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

Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'store']);
//cuando se usa post se puede tambien usar @csrf que le da mayor seguridad
Route::post('/logout', [LogoutController::class,'store'])->name('logout');

  // {user:username} Route Model Binding esto tambien requiere 
  // que los redirect()->route reciban a parte del name ()  un array 
  // ['user' => auth()->user()->username] donde se envie el nombre y el valor del parametro
  // en clos controllers o dara error
Route::get('/{user:username}',[PostController::class,'index'])->name('post.index');

Route::get('/post/create',[PostController::class,'create'])->name('post.create');