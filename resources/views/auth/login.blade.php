@extends('layouts.admin')

@section('title')

    | Login

@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">

                <div class="card-header">
                    <h6 class="mb-0">Login</h6>
                </div>

                <div class="card-body">

                    <!--  ************* Gestione lista degli errori server ****************** -->
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                     @endif

                    <!-- ***************************** -->
                    <!-- ********** Form ************* -->
                    <!-- ***************************** -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Inserisci la tua email">
                            @error('email')
                                <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Inserisci la password" autocomplete="current-password">

                            @error('password')
                                <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">Rimani connesso</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary text-white px-4">Login</button>

                        {{-- @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">Password dimenticata?</a>
                        @endif --}}

                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
