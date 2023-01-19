@extends('layouts.app')

@section('titulo')
    Inicio
@endsection

@section('contenido')
    {{--
        el contenido de qui se paso al componente "listar-post"
        --}}
    {{-- esta es la llamada del componente "listar-post" 
          cuando tiene "/" de cierre no acepta Slots  --}}

         <x-listar-post :posts="$posts" /> 


          {{-- este if no lleva >0 debido a que los boolean en php se tratan como entero
             con 0=false y cualquier otra cosa =true  --}}

        {{-- @if ($posts->count())
            <div class="justify-center items-center grid md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-8 gap-4">
                @foreach ($posts as $post)
                    <div> --}}

                        {{-- la siguiente es una referencia de una sola variable
                            <a href="{{ route('posts.show', $post) }}"> --}}
                        {{--  en el Route Model binded (RMD) de laravel soporta multiples variables de multiples modelos si esto esta
                            declarado en el controler --}}


                        {{-- <a href="{{ route('posts.show', ['post'=>$post, 'user'=>$post->user]) }}">
                            <img src="{{asset('uploads').'/'. $post->image}}" alt="Imagen del Post {{$post->titulo}}">
                        </a>
                    </div>
                @endforeach
            </div>
            <div> --}}


                {{-- esto es para agregar la paginacion que se vea si usas el metodo paginate --}}
                {{-- por defecto usa los estilos de tailwindcss pero se requiere un cambio adicional para que se noten
                    dentro del metod link puede invocar el tipo de css que deseas para paginas  --}}
                
                
                    {{-- {{ $posts->links('pagination::tailwind') }}
            </div>
        @else
            <p class="text-gray-600 uppercase text-center font-bold">
                No hay Publicaciones aún
            </p>
        @endif --}}
    

    {{-- Slot= es un valor que se muestrar en la variable Slot en el componente ej
         <x-listar-post>
             "lo que este aqui es un slot"
         </x-listar-post >
        
        --}}

    {{-- tambien se pueden usar multiples Slots dandoles nombre
        x --}}



    {{-- esta directiva hace lo mismo que lo anterior la primera parte seria el foreach y la segunda el else
    @forelse ( as )
    @empty
    @endforelse --}}


@endsection
