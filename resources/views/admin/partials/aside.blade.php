<nav class="navbar mt-4 d-flex justify-content-center">
    <ul class="navbar-nav">

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

        <li class="nav-item ">
            <a class="nav-link" href="/">Sito pubblico</a>
        </li>

    </ul>
</nav>
