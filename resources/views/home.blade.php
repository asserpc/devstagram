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
          <x-listar-post : posts="$posts" />
    
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
