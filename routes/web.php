<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;

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

/*  esto se llama croushing se recomienda usar controladores 
  Route::get('/', function () {
    return view('inicio');
}); */

//cuando un controlador tiene un solo metodo se puede hacer invocable, y entonces la ruta queda asi
Route::get('/', HomeController::class)->name('home');


Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::post('/register',[RegisterController::class,'store']);

Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'store']);
//cuando se usa post se puede tambien usar @csrf que le da mayor seguridad
Route::post('/logout', [LogoutController::class,'store'])->name('logout');

  // {user:username} Route Model Binding esto tambien requiere 
  // que los redirect()->route reciban a parte del name ()  un array 
  // ['user' => auth()->user()->username] donde se envie el nombre y el valor del parametro
  // en clos controllers o dara error
  //recordar colocar las recciones en plurar 
Route::get('/{user:username}',[PostController::class,'index'])->name('posts.index');

Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');

//guardar los post
Route::post('/posts',[PostController::class,'store'])->name('posts.store');
//visitar un post
//note el aqui el RMB tiene asociadas dos variables -- user --- y -- post -- esto es porque este esquema permite este tipo de acciones
//solo debe enviar las dos variables como un arreglo asociativo y recibir los valores
Route::get('/{user:username}/posts/{post:titulo}',[PostController::class,'show'])->name('posts.show');

//almacenando los comentarios
Route::post('/{user:username}/posts/{post:titulo}',[ComentarioController::class,'store'])->name('comentarios.store');

//para eliminar post
Route::delete('/posts/{post:titulo}',[PostController::class,'destroy'])->name('posts.destroy');


//para guardar las imagenes
Route::post('/imagenes', [ImagenController::class,'store'])->name('imagenes.store');


//likes
Route::post('/posts/{post:titulo}/likes',[LikeController::class,'store'])->name('posts.likes.store');
//remover likes
Route::delete('/posts/{post:titulo}/likes',[LikeController::class,'destroy'])->name('posts.likes.destroy');

//rutas al perfil y edicion
Route::get('/{user:username}/editar-perfil',[PerfilController::class,'index'])->name('perfil.index');
Route::post('/{user:username}/editar-perfil',[PerfilController::class,'store'])->name('perfil.store');

//para guardar seguidores
Route::post('/{user:username}/follow',[FollowerController::class,'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow',[FollowerController::class,'destroy'])->name('users.unfollow');