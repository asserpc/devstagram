<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post)
    {
        //validar
       $this->validate($request, [
        'comentario'=>'required|max:255'
       ]);

       //alamacenar resultados
       //tener presente que el user_id aca no es el modelo que se pasa sino el usuario autenticado
       // es por ello que no se usa $user sino auth()
       //luego llevar esto al fillable en Comentario.php
       Comentario::create([
        'user_id'=> auth()->user()->id,
        'post_id'=> $post->id,
        'comentario'=> $request->comentario
       ]);

       //retornando el mensaje
       return back()->with('mensaje', 'comentario realizado correcto');

    }
}
