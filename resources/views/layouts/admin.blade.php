<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>DeliveBoo @yield('title')</title>

    <link rel="icon" href="https://cwa.roocdn.com/_next/static/favicon-32x32.9ac59871.png">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/appBlade.js'])

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
    <div id="app" class="container-xxl p-0">

        <header>
            @include('admin.partials.header')
        </header>

        <div class="container-fluid p-0">

            <div class="row h-100">

                <!--    ASIDE MENU -->
                @auth
                    <aside class="d-none d-lg-block col-lg-2 p-0">
                        @include('admin.partials.aside')
                    </aside>
                @endauth

                <!--    MAIN CONTENT -->
                <div class="@auth col-12 col-lg-10 dashboard-main  @else login-main col-12 @endauth p-0">

                    <main class="main container-fluid overflow-scroll p-0 py-5 position-relative">

                        {{-- shape divider --}}
                        <div class="custom-shape-divider-top-1676714921">
                            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                                preserveAspectRatio="none">
                                <path d="M1200 120L0 16.48 0 0 1200 0 1200 120z" class="shape-fill"></path>
                            </svg>
                        </div>

                        <div class="custom-shape-divider-bottom-1676715405">
                            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                                preserveAspectRatio="none">
                                <path d="M1200 120L0 16.48 0 0 1200 0 1200 120z" class="shape-fill"></path>
                            </svg>
                        </div>

                        <div class="h-100 px-3 pe-lg-4">

                            @yield('content')

                        </div>

                    </main>

                </div>

            </div>

        </div>

        @auth
            <footer>
                @include('admin.partials.footer')
            </footer>
        @endauth

    </div>
</body>

</html>
