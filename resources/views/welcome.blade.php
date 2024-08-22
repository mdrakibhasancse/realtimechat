<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
     
    </head>
    <body class="">
        <div class="container pt-5">
            @if (Route::has('login'))
                <div class="">
                    @auth
                        <a href="{{ url('/home') }}" class="btn btn-secondary btn-sm">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-success btn-sm">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        <div>
            <h1 class="text-4xl">
                Welcome To Real Time Laravel Chat, Login To Start!
            </h1>
        </div>
        </div>
    </body>
</html>
