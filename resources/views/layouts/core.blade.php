<!-- Stored in resources/views/layouts/master.blade.php -->

<html>
    <head>
        <title>App Name - @yield('title')</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <script src = "{{ asset("ui/jquery.min.js") }}"></script>
        <link href="{{ asset("ui/semantic.min.css") }}" rel="stylesheet">
        <script src = "{{ asset("ui/semantic.min.js") }}">
        </script>
        <style>

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }
        </style>
    </head>
    <body>

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>