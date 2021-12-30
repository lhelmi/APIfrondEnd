<html>
    <head>
        <meta charset="utf-8">
        
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            @yield('content')
            @stack('scripts')
        </div>
    </body>
</html>
