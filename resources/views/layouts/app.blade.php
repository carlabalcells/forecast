<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @stack('styles')
        <title>Weather Forecast - @yield('titulo') </title>     
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
        <script src="{{ asset('js/app.js') }}" defer></script>     
    </head>

    <body class="bg-gray-100">
        
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between items-center">
               
                
                @auth
                <a href="{{ route('home') }}" class="text-3xl font-black">Forecast</a>
               
                <nav class="flex gap-2 items-center">
                    <a href="{{ route('profile.index') }}" class="font-bold text-gray-600 text-sm"> Welcome: 
                        <span class="font-normal"> {{ auth()->user()->username }} </span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="font-bold uppercase text-gray-600 text-sm" > Close Session </button>
                    </form>
                </nav> 
                @endauth

                @guest
                    <a href="{{ route('register') }}" class="text-3xl font-black">Forecast</a>                
                    <nav class="flex gap-2 items-center">
                        <a href="{{ route('login') }}" class="font-bold uppercase text-gray-600 text-sm"> Login </a>
                        <a href="{{ route('register') }}" class="font-bold uppercase text-gray-600 text-sm" > Sign Up </a>
                    </nav>             
                @endguest
            </div>
               
        </header>

        <main class="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10">
                 @yield('titulo') 
            </h2>                       

            @yield('contenido')
        </main>       

        <footer class="text-center p-5 text-gray-500 font-bold uppercase mt-10">
            Weather Forecast - All rights reserved 
            {{ now()->year }}
        </footer>
        
    </body>
</html>