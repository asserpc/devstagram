@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="continer mx-auto md:flex">
        <div class="md:w-1/2 ">
            <img class="max-w-lg max-h-lg" src="{{ asset('uploads').'/'.$post->image }}"
                 alt=" imagen de {{ $post->titulo }} "/>
            <div class="p-3 flex items-center gap-4">
               @auth
                    {{-- crear variable php --}}
                    {{-- @php
                        $mensaje="Este mensaje es desde show";
                    @endphp --}}

                    {{-- agregando el componente livewire
                        los comnponentes livewire se agregan con la etiqueta <livewire: "nombre del componente"/> --}}
                    <livewire:like-post :post="$post" />    
                    @if ( $post->checkLike(auth()->user() ))
                        <form action="{{ route('posts.likes.destroy',$post) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <div  class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" 
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                    </svg>
                                </button>  
                            </div>
                        </form>
                    @else
                        <form action="{{ route('posts.likes.store',$post) }}" method="post">
                            @csrf
                        
                            <div  class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                    </svg>
                                </button>  
                            </div>
                        </form>
                    @endif
               @endauth
                <p>
                    {{ $post->likes->count() }} likes
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
                                font-bold mt-4 cursor-pointer">
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