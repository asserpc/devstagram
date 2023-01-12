@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="continer mx-auto md:flex">
        <div class="md:w-1/2 lg:ml-4">
            <img class="max-w-lg max-h-lg" src="{{ asset('uploads').'/'.$post->image }}" alt=" imagen de {{ $post->titulo }} "/>
            <div class="p-3">
                <p>
                    0 likes
                </p>
            </div>
            <div >
                <p class="font-bold">
                    {{ 'Autor: '.$post->user->username }}
                </p>
                <p class="text-sm text-gray-700">
                    {{-- $post->created-at hace mencicion a columna creado cuando-
                        ahora bien como laravel tiene integrada la API carbon para fortmateo de fechas
                        puedes entonces aplicarlo a la columna created_at --}}
                    {{ $post->created_at->diffForHumans()}}
                </p>
                <p class="mt-5">
                    {{ 'Decripcion: '.$post->description }}
                </p>
            </div>
            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form action="{{ route('posts.destroy', $post) }}" method="post">
                        {{-- metodo spoofing: son metodos de laravel que no son nativos de html --}}
                        @method('DELETE')
                        @csrf
                        <input 
                            type="submit" 
                            value="Eliminar Publicacion"
                            class="bg-red-500 hover:bg-orange-600 p-2 rounded-lg text-white 
                                font-bold mt-4 cursor-pointer"/>
                    </form>
                @endif
            @endauth
           

        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow p-5 mb-5  bg-white">
                @auth
                    <p class="text-xl font-bold text-center mb-4">
                        Agrega un nuevo comentario
                    </p>
                    @if (session('mensaje'))
                        <div class="bg-green-400 p-2 rounded-xl mb-6 text-white uppercase font-bold">
                            {{ session('mensaje') }}
                        </div>
                    @endif
                    <form action="{{ route('comentarios.store', ['post'=>$post, 'user'=>$user]) }}" method="post">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block uppercase text-gray-600 font-bold">
                                Comentario
                            </label>
                            <textarea 
                                id="comentario" 
                                name="comentario" 
                                placeholder="Ingresa tu comentario"
                                class="border p-3 w-full rounded-lg  @error('name') border-red-600 @enderror"
                            ></textarea>
                            @error('comentario')
                                <p class="bg-red-700 text-white my-2 rounded-lg text-sm p-2 text-center ">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <input type="submit" value="Comentar" 
                        class="bg-sky-800 hover:bg-amber-700 trasitions-colora 
                        cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                    </form>
                @endauth
                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <a class="font-bold" href="{{ route('posts.index', $comentario->user) }}">
                                        {{ $comentario->user->username }}
                                </a>
                                <p>
                                    {{  $comentario->comentario  }}
                                </p>
                                <p class="text-sm text-gray-700 ">
                                    {{  $comentario->created_at->diffForHumans()  }}
                                </p>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-700 p-5 mb-10 items-center">No Hay Comentarios</p>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection