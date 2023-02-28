<nav class="navbar navbar-expand-lg navbar-light h-100 bg-white">
    <div class="container-fluid h-100">

        <a class="navbar-brand d-flex align-items-center" href="@auth {{ route('admin.home') }} @else {{ route('home') }} @endauth">

            <div class="logo">
                <img src="https://creativereview.imgix.net/content/uploads/2016/09/Deliveroo-Logo-Crop.png" alt="Deliveboo logo">
            </div>

            <h4 class="text-primary pt-3">deliveboo</h4>

        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse d-lg-flex justify-content-end " id="navbarSupportedContent">


            <ul class="navbar-nav ml-auto">

                @guest

                    @if (Route::currentRouteName() == 'register')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endif

                    @if (Route::currentRouteName() == 'login')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Registrati</a>
                        </li>
                    @endif

                @else

                    <li>
                        <form  action="{{route('admin.foods.index')}}" method="GET" class="d-flex align-items-center">
                            @csrf
                            <input class="form-control me-1 d-inline-block w-75" name="search" type="text" placeholder="Cerca un piatto">
                            <button class="btn btn-primary btn-sm text-white" type="submit">Cerca</button>
                        </form>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link @if(Route::currentRouteName() === 'admin.foods.create') active @endif" href="{{route('admin.foods.create')}}">Crea piatto</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link @if(Route::currentRouteName() === 'admin.home') active @endif" href="{{route('admin.home')}}">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link @if(Route::currentRouteName() === 'admin.foods.index') active @endif" href="{{route('admin.foods.index')}}">Men&ugrave;</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link @if(Route::currentRouteName() === 'admin.orders') active @endif" href="{{route('admin.orders')}}">Ordini</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link @if(Route::currentRouteName() === 'admin.statistics') active @endif" href="{{route('admin.statistics')}}">Report</a>
                    </li>

                    <li class="nav-item d-lg-none">
                        <a class="nav-link" href="/">Sito pubblico</a>
                    </li>


                    <li class="nav-item">

                        <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </li>

                @endguest

            </ul>

        </div>
    </div>

</nav>



