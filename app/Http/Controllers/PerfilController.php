<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        //obliga a estar autenticado para ver la vista
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        //dd('Aqui esta el formulario ...');
        return view ('perfil.index',[
             'user'=>$request->user
        ]);
    }

    public function store(Request $request)
    {
        $request->request->add(['username'=>Str::slug($request->username)]);
      
        //cuando son mas de tres reglaS de validacion se recomienda que sea un array
        //Rule es un modelo que se utiliza para agregar reglas mas especificas
        $this->validate($request,[                
             'username' => [
                'required',
                Rule::unique('users','username')->ignore(auth()->user()),'min:3','max:20']
        ]);

        if ($request->imagen) {

            //nombre del campo
            $imagen=$request->file('imagen');
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000,1000);
            //nombre de la carpeta
            $imagenPath= public_path('perfiles')."/". $nombreImagen; 
            $imagenServidor->save($imagenPath);
        }

        $usuario= User::find(auth()->user()->id);
        $usuario->username = $request->username;
        //usuario - > imagen porque es la columna de BD
        $usuario->imagen=$nombreImagen ?? auth()->user()->imagen ?? null;
        //guardar los cambios
        $usuario->save();

        //redireccionar al muro
        return redirect()->route('posts.index',$usuario->username);
    }
}
