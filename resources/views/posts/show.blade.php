@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="continer mx-auto flex">
        <div class="md:w-1/2">
            <img class="max-w-80 max-h-80" src="{{ asset('uploads').'/'.$post->image }}" alt=" imagen de {{ $post->titulo }} "/>
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
                    {{ 'Decripcion: ' $post->description }}
                </p>
            </div>

        </div>
        <div class="md:w-1/2">
            2
        </div>

    </div>
@endsection