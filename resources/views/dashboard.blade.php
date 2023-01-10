@extends('layouts.app')


@section('titulo')
    Perfil: {{ $user->username }}
@endsection


@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ asset('img/usuario.svg') }}" alt="imgen usuario">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10 ">
                <p class="text-blue-700 text-3xl">{{ $user->username }}</p>

                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                   0
                   <span class="font-normal">Seguidores</span> 
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                   0
                   <span class="font-normal">Siguiendo</span> 
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                   0
                   <span class="font-normal">Post</span> 
                </p>
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">
            Publicaciones
        </h2>
        @if ($posts->count()>0)
        <div class="grid md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-8 gap-4">
            @foreach ($posts as $post)
                <div>
                    <a href="#">
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

