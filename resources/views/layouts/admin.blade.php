<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DeliveBoo @yield('title')</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/appBlade.js'])


    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
    <div id="app">

        <!--    NAVBAR -->
        @include('admin.partials.header')

        <div class="container-fluid main-wrapper">
            <div class="row h-100">
                <!--    ASIDE MENU -->
                @auth
                    <div class="col-1 col-md-2 main-wrapper bg-warning">
                        @include('admin.partials.aside')
                    </div>
                @endauth

                <!--    MAIN CONTENT -->
                <main class="@auth col-10 @endauth main-wrapper">
                    @yield('content')
                </main>
            </div>
        </div>

        <!--    FOOTEER -->
        @include('admin.partials.footer')
    </div>
</body>

</html>
