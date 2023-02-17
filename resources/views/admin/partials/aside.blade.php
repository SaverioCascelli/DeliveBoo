<aside>
    <nav class="navbar navbar-expand-md">
        <div class="">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#asideSupportedContent" aria-controls="asideSupportedContent"
                aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="asideSupportedContent">
                <!-- Left Side Of Navbar -->


                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto d-flex flex-column">
                    <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a id="" class="nav-link" href="{{route('admin.home')}}"
                                aria-haspopup="true" aria-expanded="false">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="" class="nav-link" href="{{route('admin.foods.index')}}" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                Menu
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="" class="nav-link" href="{{route('admin.foods.create')}}" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                Aggiungi Piatto
                            </a>
                        </li>
                </ul>
            </div>
        </div>
    </nav>




</aside>
