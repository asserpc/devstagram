@extends('layouts.app')

@section('titulo')
    Inicia Sesion en devstagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-8 md:items-center ">
        <div class="md:w-5/12 p-5">
            <img src="{{ asset('img/login.jpg') }}" alt="imagen Inicio de Sesion" >
            
        </div>
        <div class="md:w-4/12 bg-white rounded-lg p-6 shadow-2xl">
            <form method="POST" action="{{ route('login') }}" novalidate >
                @csrf
                @if (session('mensaje'))
                    <p class="bg-red-700 text-white my-2 rounded-lg text-sm p-2 text-center ">
                        {{ session('mensaje') }}
                    </p>
                @endif
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-600 font-bold">Email</label>
                    <input id="email" name="email" type="email" placeholder="Tu Email"
                        class="border p-3 w-full rounded-lg @error('email') border-red-600 @enderror"
                        value="{{ old('email') }}" 
                    />
                    @error('email')
                        <p class="bg-red-700 text-white my-2 rounded-lg text-sm p-2 text-center ">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-600 font-bold">Clave</label>
                    <input id="password" name="password" type="password" placeholder="Tu Clave"
                        class="border p-3 w-full rounded-lg @error('password') border-red-600 @enderror"
                        value="{{ old('password') }}" />
                    @error('password')
                        <p class="bg-red-700 text-white my-2 rounded-lg text-sm p-2 text-center ">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5"> 
                    <input type="checkbox" name="remember" id="remember">
                    <label class=" text-gray-800">Mantener Sesión</label>
                </div>

                <input type="submit" value="Iniciar Sesion" 
                    class="bg-sky-800 hover:bg-amber-700 trasitions-colora cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection