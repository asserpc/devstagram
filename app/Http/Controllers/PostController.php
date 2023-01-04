<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //proteger la pestaña del muro
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //dd(auth()->user() );
        return view('dashboard');
    }
}
