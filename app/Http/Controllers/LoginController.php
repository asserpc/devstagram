<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index()
    {
            return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //intentar validar al usuario para evitar errores
        if (!auth()->attempt($request->only('email','password'))) {
            return back()->with('mensaje','Credenciales Incorrectas');
        }

        //si todo ok enviarlo al post
        return redirect()->route('post.index');
    }
}
