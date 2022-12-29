<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Registercontroller extends Controller
{
    //
    public function index() 
    {
        return view('auth.register');
    }
    public function store(Request $request) 
    {
        #dd('Post...'); //dd es un metodo que imprime en pantalla y detiene la ejecucion
       // dd($request->get('name'));
        
       //Validaciones
       $this->validate($request,[
            'name' => 'required|min:5',
       ]);
        
    }
}
