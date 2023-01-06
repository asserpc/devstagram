@extends('layouts.app')
{{-- aqui con el uso de @push  lo que se hace es importar una hoja de estilo en una sola pagina
      debe estar en app.blade.php un directiva @stack('styles') que indica donde se hara el importado--}}
@push('styles')
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
@endpush

@section('titulo')
    Crea una Nueva Publicacion
@endsection

@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form  id="dropzone"  method="POST" enctype="multipart/form-data"
            class="dropzone border-dashed border-2 w-full h-96 rounded flex 
            flex-col justify-center items-center" 
            action="{{ route('imagenes.store')}}">
                @csrf
            </form>
        </div>
        <div class="md:w-1/2 px-10 bg-white rounded-lg p-6 shadow-2xl mt-10 md:mt-0">
            <form action="{{ route('register') }}" method="POST" novalidate >
                @csrf
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-600 font-bold">Titulo</label>
                    <input id="titulo" name="titulo" type="text" placeholder="Titulo"
                        class="border p-3 w-full rounded-lg  @error('name') border-red-600 @enderror"
                        value="{{ old('titulo') }}" 
                    />
                    @error('titulo')
                        <p class="bg-red-700 text-white my-2 rounded-lg text-sm p-2 text-center ">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-600 font-bold">
                        Descripción
                    </label>
                    <textarea 
                        id="descripcion" 
                        name="descripcion" 
                        placeholder="Descripcion del Post"
                        class="border p-3 w-full rounded-lg  @error('name') border-red-600 @enderror"
                    >{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="bg-red-700 text-white my-2 rounded-lg text-sm p-2 text-center ">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <input type="submit" value="Publicar" 
                    class="bg-sky-800 hover:bg-amber-700 trasitions-colora 
                    cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>    
        </div>
    </div>
@endsection