<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //proteger la pestaña del muro
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
       // dd($user->username);
        return view('dashboard', [
            'user'=>$user,
        ]);
    }

    // esta funcion permite mostar la pagina y subir imagenes
    public function create()
    {
        return view('posts.create');
    }

    // este metodo almacena el post en la BD
    public function store(Request $request)
    {
        $this->validate($request, [
        'titulo'=>'required|max 250',
        'description'=>'required',
        'image'=>'required',
        ]);
    }
}
