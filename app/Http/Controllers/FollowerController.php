<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    
    public function store(User $user, Request $request)
    {
        //el metodo attach se utiliza con mayor frecuencias en tablas que se referencian a si mismas
        //de ese modo tiene el id de $user y se argrea el usuario que le sigue
        $user->followers()->attach(auth()->user()->id);
        return back();
    }
}
