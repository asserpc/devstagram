@extends('layouts.app')


@section('titulo')
    Perfil: {{ $user->username }}
@endsection


@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                {{--  $user->imagen ? asset('perfiles').'/'.$user->imagen : asset('img/usuario.svg')
                    significa que si la variable igaen de user tiene info la imprima sino la default--}}
                <img src="{{ $user->imagen ? asset('perfiles').'/'.$user->imagen : asset('img/usuario.svg') }}" alt="imgen usuario">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10 ">
                <div class="flex items-center gap-2">
                    <p class="text-blue-800 text-3xl">{{ $user->username }}</p>
                    @auth
                        @if ($user->id===auth()->user()->id)
                            <a href="{{  route('perfil.index',$user) }}" class="text-blue-500 hover:text-blue-800 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                  </svg>
                                  
                            </a>
                            
                        @endif
                    @endauth
                </div>
               

                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                   0
                   <span class="font-normal">Seguidores</span> 
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                   0
                   <span class="font-normal">Siguiendo</span> 
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                   {{ $user->posts->count() }}
                   <span class="font-normal">Post</span> 
                </p>
                @auth
                    @if ($user->id!=auth()->user()->id)
                        
                        <form action="" 
                            method="post">
                            @csrf
                            <input 
                                class="bg-blue-600 text-white uppercase text-sm px-3 py-1 rounded-xl 
                                font-bold cursor-pointer"
                                type="submit" value="Seguir">
                        </form>
                        <form action="" 
                            method="post">
                            @csrf
                            <input 
                                class="bg-red-600 text-white uppercase text-sm px-3 py-1 rounded-xl 
                                font-bold cursor-pointer"
                                type="submit" value="Dejar de Seguir">
                        </form>
                    
                    
                    @endif
                    
                @endauth
                
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">
            Publicaciones
        </h2>
        {{-- probando un mensaje --}}
        @if (session('mensaje'))
            <p class="bg-green-500 text-black rounded-xl p-5 mb-4 text-center">
                {{ session('mensaje') }}
            </p>
            
        @endif
        
        
        {{-- este if no lleva >0 debido a que los boolean en php se tratan como entero
             con 0=false y cualquier otra cosa =true  --}}
        @if ($posts->count())
        <div class="justify-center items-center grid md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-8 gap-4">
            @foreach ($posts as $post)
                <div>
                    {{-- la siguiente es una referencia de una sola variable
                         <a href="{{ route('posts.show', $post) }}"> --}}
                    {{--  en el Route Model binded (RMD) de laravel soporta multiples variables de multiples modelos si esto esta
                          declarado en el controler --}}
                    <a href="{{ route('posts.show', ['post'=>$post, 'user'=>$user]) }}">
                        <img src="{{asset('uploads').'/'. $post->image}}" alt="Imagen del Post {{$post->titulo}}">
                    </a>
                </div>
            @endforeach
        </div>
        <div>
            {{-- esto es para agregar la paginacion que se vea si usas el metodo paginate --}}
            {{-- por defecto usa los estilos de tailwindcss pero se requiere un cambio adicional para que se noten
                  dentro del metod link puede invocar el tipo de css que deseas para paginas  --}}
            {{ $posts->links('pagination::tailwind') }}
        </div>
        @else
            <p class="text-gray-600 uppercase text-center font-bold">
                No hay Publicaciones aún
            </p>
        @endif
       

        
    </section>
@endsection

