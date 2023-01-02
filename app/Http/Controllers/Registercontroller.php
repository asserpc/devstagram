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
       // dd('Post...'); 
       // dd($request->get('name'));
        
       //Validaciones
       //esto puede ser tambien expresado como un array  ejem ['required', 'min:5']
       //username puedes dejarlo unique:table,column,except,id
       $this->validate($request,[
            'name' => 'required|min:5',   
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required',
            
       ]);
        
    }
}
