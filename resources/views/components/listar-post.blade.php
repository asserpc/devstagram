<div>
    
    {{-- este es la base de un componente  se usa para reusar codigo tanto estatico como 
        dinamico
        todo lo que esta aqui se puede mostrar con la etiqueta <x-"nombre_componente" "/"> ó adicionando slot --}}

    {{-- para usar slot generico se usa {{ $slot}} = esto imprime el slot sin nombre
          tambien puedes imprimir slots por su nombre  {{ $prueba }} suponiendo que en la view tengas
            dentro de un componente un 
            <x-slot:prueba>
                "contenido del slot llamado prueba"
            </x-slot:prueba> --}}
            
    @if ($posts->count())
        <div class="justify-center items-center grid md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-8 gap-4">
            @foreach ($posts as $post)
                <div>
                    {{-- la siguiente es una referencia de una sola variable
                        <a href="{{ route('posts.show', $post) }}"> --}}
                    {{--  en el Route Model binded (RMD) de laravel soporta multiples variables de multiples modelos si esto esta
                        declarado en el controler --}}
                    
                    <a href="{{ route('posts.show', ['post'=>$post, 'user'=>$post->user]) }}">
                        <img src="{{asset('uploads').'/'. $post->image}}" alt="Imagen del Post {{$post->titulo}}">
                    </a>
                </div>
            @endforeach
        </div>
        <div class="my-10">
            {{-- esto es para agregar la paginacion que se vea si usas el metodo paginate --}}
            {{-- por defecto usa los estilos de tailwindcss pero se requiere un cambio adicional para que se noten
                dentro del metod link puede invocar el tipo de css que deseas para paginas  --}}
            {{ $posts->links('pagination::tailwind') }}
        </div>
    @else
        <p class="text-center"> No Hay posts</p>
    @endif

</div>