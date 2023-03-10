<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    
    public function store(User $user)
    {
        //el metodo attach se utiliza con mayor frecuencias en tablas que se referencian a si mismas
        //de ese modo tiene el id de $user y se argrea el usuario que le sigue
        $user->followers()->attach(auth()->user()->id);
        return back();
    }

    public function destroy(User $user)
    {
        //el metodo detach se utiliza con mayor frecuencias en tablas que se referencian a si mismas
        //de ese modo tiene el id de $user y se argrea el usuario que le sigue
        $user->followers()->detach(auth()->user()->id);
        return back();
    }

}
