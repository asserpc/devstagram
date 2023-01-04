<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class LogoutController extends Controller
{
    //
    public function store(Request $request )
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
