<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel = "icon" href = "{{ asset('images/favicon.ico') }}" type = "image/x-icon"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    @yield('css')

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <!-- PRELOADER -->
    <img id="preloader" src="{{ asset('images/preloader.gif') }}" alt="" />
    <div id="app" class="preloader_hide">
        <div id="page" class="single_page">
            @if(auth()->check())
                @include('includes.navbar')
                @include('partials._breadcrumb')
            @else
                @include('includes.auth.navbar')
            @endif
            
            @yield('above-navbar')

            <section id="blog">
                <div class="container">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </section>
        </div>
    
        @if(auth()->check())
            @include('includes.footer')
        @else
            @include('includes.auth.footer')
        @endif
    </div>

    <!-- Scripts -->
    <script src="{{ elixir('js/template.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    
    @yield('js')
</body>
</html>
