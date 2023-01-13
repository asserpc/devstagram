<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //protege los post de manera que solo sean accesibles si el usuario esta autenticado
    //$this->middleware('auth');
    //tambien puedes agregar excepciones a lo anterior con
    //except(['metodos','...'....])
    public function __construct()
    {
        $this->middleware('auth')->except(['show','index']);
    }

    public function index(User $user)
    {
        
        //cuando se usa esta forma primero se coloca la columna de la tabla y luego el dato variable
        // Post::where('user_id',$user->id)-> el metodo ->get() devuelve todos los Post = lista indefinida
        // tambien puedes paginar los resultados usando el metodo: ->paginate(cant_reg_por_pagina)
        //$posts= Post::where('user_id',$user->id)->get();
        //tambie esta ->simplePaginate() que hace una paginacion solo agregando siguiente y anterior;
        $posts= Post::where('user_id',$user->id)->paginate(4);
       // dd($post);

       // aqui a la vista se le envia el usuario
       // adicional se le envian los post
        return view('dashboard', [
            'user'=>$user,
            'posts'=>$posts
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
       // dd($request);

        $this->validate($request, [
        'titulo'=>'required',
        'description'=>'required',
        'image'=>'required',
        ]);

        Post::create([
            'titulo'=> $request->titulo,
            'description'=>$request->description,
            'image'=>$request->image,
            'user_id'=>auth()->user()->id
        ]);

        //otra forma de guardar 
        /**
         * $post= new Post;
         * $post->titulo=$request->titulo;
         * $post->description=$request->description;
         * $post->image=$request->image
         * $post->user_id=auth()->user()->id;
         * 
         */

         //tercera Forma de guardar post usando la relacion
         /**
          * esta forma aunque se ve mas compleja es mas como laravel
          * 
          * $request->user()->post()->create([
          *  'titulo'=> $request->titulo,
          * 'description'=>$request->description,
          *  'image'=>$request->image,
          * 'user_id'=>auth()->user()->id
          *]);
          * 
         */

          //cualquiera de las tres es identica

        return redirect()->route('posts.index', auth()->user()->username); 
    }

    //este metodo es para mostrar los post y que se puedan comentar, dar like etc
    // al recibir un objeto Post entonces $post tambien se puede envia a la vista
    //podemos recibir varias variables a la vez e incluso pasarlas a la vista
    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post'=>$post,
            'user'=>$user
        ]);
    }

    public function destroy(Post $post)
    {
       //esta es una validacion basada en la policy 
       $this->authorize('delete',$post);
       //elimina el post
       //dd($post->image);
       $post->delete();
        // cuando se elimina un post de la bd tambien se debe eliminar la imagen asociada a ese post de uploads
        //eliminado la imagen fisica
        //es posible que sea image... 
        
        $imagen_path=public_path('uploads/'.$post->image);
        
        if (File::exists($imagen_path)) {
            //de laravel existe 
            //File::unlink($imagen_path);
            // de php tambien existe directamente 
            unlink($imagen_path);
        }

        //regresa al muro y mensaje de exito
       return redirect()->route('posts.index',auth()->user()->username)->with('mensaje','Publicacion elimianda con exito');
    }
}
