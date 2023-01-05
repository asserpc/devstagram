<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Registercontroller extends Controller
{
    //
    public function index() 
    {
        return view('auth.register');
    }
    public function store(Request $request) 
    {
       // dd('Post...'); 
       //alterando el request
        $request->request->add(['username'=>Str::slug($request->username)]);
       //Validaciones
       //esto puede ser tambien expresado como un array  ejem ['required', 'min:5']
       //username puedes dejarlo unique:table,column,except,id
       $this->validate($request,[
            'name' => 'required|min:5',   
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:4',
            
       ]);
        
       // agregar el registro a la base de datos funciona como un inser into
       User::create([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=> Hash::make( $request->password),
       ]
       );

       //Autenticar un usuario
        //    auth()->attempt([
        //         'email'=>$request->email,
        //         'password'=> $request->password, 
        //    ]);

        //Otra forma de autenticar al usuario
        auth()->attempt($request->only('email','password'));

       //redireccional al muro
        return redirect()->route('post.index', ['user' => auth()->user()->username]);
    }
}
