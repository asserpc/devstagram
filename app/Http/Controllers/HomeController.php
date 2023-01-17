<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function __invoke()
    {

        //dd(auth()->user()->followings->pluck('id')->toArray());
        //obtener a quienes seguimos
        //el metodo pluck permite especificar que campos de la BD traerse
        //si se quieren todos los campos se omite el pluck
        //con la funcion toArray se obtienen los resultados en un arreglo
        $ids=auth()->user()->followings->pluck('id')->toArray();
        //ahora con whereIn obtenemos una consulta filtrada por la columna indicada y el grupo de info
        //contenido en un arreglo en este caso Columna= user_id y el Arreglo = $ids
        //puedes usar gets y se traera todos los resultados o paginate para traer cierta cantidad
        //el metodo latest() = ordena los registros de ultimo a primero
        //importante debe ordenarse antes de paginar
        $posts = Post::whereIn('user_id',$ids)->latest()->paginate(20);

        return view('home',[
            'posts'=>$posts
        ]);
    }
}
