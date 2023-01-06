<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //
    public function store(Request $request)
    {
        $imagen=$request->file('file');
        $nombreImagen = Str::uuid() . "." . $imagen->extension();
        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(1000,1000);

        //direccion der servidor para guardar
        //se crea ademas la carpeta uploads en la carpeta public
        $imagenPath= public_path('uploads')."/". $nombreImagen; 
        //guardando la imagen en servidor
        $imagenServidor->save($imagenPath);

        //retornando el nombre para la BD
        return response()->json([ 'imagen'=> $nombreImagen ]);

    }
}

