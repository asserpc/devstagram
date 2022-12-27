<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Devtagram - @yield('titulo')</title>
        @vite('resources/css/app.css')
    </head>
    <body>
        
       <H1 class="text-4xl">@yield('titulo')</H1>
       <hr>
       <p>@yield('contenido')</p>  
    </body>
</html>
