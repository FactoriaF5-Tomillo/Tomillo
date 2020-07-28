<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header>
            <h1>Tomillo</h1>
        </header>
        <main class="">
            <div class="side-bar">
                <div class="nav-buttons">
                    <a href="/courses" class="btn btn-secondary">Cursos</a>
                    <a href="/students" class="btn btn-secondary">Alumnos</a>
                    <a href="/teachers" class="btn btn-secondary">Profesores</a>
                </div>
            </div>
            <div class="content">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
