@extends('layouts.app')

@section('titulo')
    Editar perfil: {{ auth()->user()->username}}
   {{--  @if(auth()->user()->username === $user)
        
    @else
        //falta como enviarlo de forma automatica a otra ruta
    @endif --}}
    
@endsection

@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 bg-white shadow-lg p-6">
            <form  class=" mt-10 md:mt-0"
            action="{{ route('perfil.store',auth()->user()->username) }}" method="post"
              enctype="multipart/form-data">
               @csrf
                <div class="mb-5">
                    <label for="username" 
                        class="mb-2 block uppercase text-gray-600 font-bold">
                        Username
                    </label>
                    <input id="username" 
                        name="username" 
                        type="text" 
                        placeholder="Tu Nombre de Usuario"
                        class="border p-3 w-full rounded-lg  
                        @error('username') border-red-600 @enderror"
                        value="{{ auth()->user()->username }}" 
                    />
                    @error('username')
                        <p class="bg-red-700 text-white my-2 rounded-lg text-sm p-2 text-center ">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="imagen" 
                        class="mb-2 block uppercase text-gray-600 font-bold">
                        Username
                    </label>
                    <input id="imagen" 
                        name="imagen" 
                        type="file" 
                        class="border p-3 w-full rounded-lg"
                        accept=".jpg, .jpeg, .png, .svg, .webp, .gif"
                    />
                </div>
                <input type="submit" value="Actualizar" 
                    class="bg-sky-800 hover:bg-amber-700 trasitions-colora 
                    cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection