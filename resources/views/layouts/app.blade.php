<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Devtagram - @yield('titulo')</title>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-200">
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-3xl font-black">
                    Devstragram
                </h1>
                <nav class="flax gap-3 items-center">
                    <a class="font-blod uppercase text-gray-600 text-sm" href="/">Inicio</a>
                    @auth
                        <a class="font-blod uppercase text-gray-600 text-sm" href="{{ route('logout') }}">Logout</a>
                        Hola: <span> {{ auth()->user()->name }}</span>
                       
                    @endauth
                    @guest
                        <a class="font-blod uppercase text-gray-600 text-sm" href="{{ route('login') }}">Login</a>
                        <a class="font-blod uppercase text-gray-600 text-sm" href="{{ route('register') }}">Registrate</a>
                    @endguest
                </nav>
        </div>
        </header>

        <Main class="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10">
                @yield('titulo')
            </h2>
            @yield('contenido')
        </Main>

        <footer class="mt-10 text-center p-5 text-blue-800 font-bold uppercase">
            Deitotec@ .Todos los Derechos reservados {{now()->year}}
        </footer>
  
    </body>
</html>