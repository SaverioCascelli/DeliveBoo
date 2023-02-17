@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registrazione</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!--  NOME ATTIVITA'  -->
                            <div class="mb-4 row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nome</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name">

                                    @error('Nome Attivita')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!--  MAIL ATTIVITA'  -->
                            <div class="mb-4 row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="piva" class="col-md-4 col-form-label text-md-right">Nome Ristorante</label>

                                <div class="col-md-6">
                                    <input id="restaurantName" type="text"
                                        class="form-control @error('restaurantName') is-invalid @enderror"
                                        name="restaurantName" value="{{ old('restaurantName') }}" required
                                        autocomplete="restaurantName">

                                    @error('PIVA')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!--  PIVA ATTIVITA'  -->
                            <div class="mb-4 row">
                                <label for="piva" class="col-md-4 col-form-label text-md-right">PIVA</label>

                                <div class="col-md-6">
                                    <input id="piva" type="text"
                                        class="form-control @error('piva') is-invalid @enderror" name="piva"
                                        value="{{ old('piva') }}" required autocomplete="piva">

                                    @error('PIVA')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <!--  INDIRIZZO ATTIVITA'  -->
                            <div class="mb-4 row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">Indirizzo</label>

                                <div class="col-md-6">
                                    <input id="address" type="text"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address') }}" required autocomplete="address">

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <!--  TIPOLOGIA CUCINA ATTIVITA'  -->
                            <div class="mb-4 row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">Tipologia Cucina</label>


                                <!--#################### DATI DA CICLARE ########################-->
                                <div class="col-md-4 row">
                                    <div class="form-check col">
                                        <input class="form-check-input" type="checkbox" name="typologies[]" id="argentina"
                                            value="argentina">
                                        <label class="form-check-label" for="argentina">
                                            Argentina
                                        </label>
                                    </div>
                                    <div class="form-check col">
                                        <input class="form-check-input" type="checkbox" name="typologies[]" id="italiana"
                                            value="italiana">
                                        <label class="form-check-label" for="italiana">
                                            Italiana
                                        </label>
                                    </div>

                                    <!--
                                              <div class="form-check col">
                                                <input class="form-check-input" type="checkbox" name="exampleRadios" id="americana" value="option2">
                                                <label class="form-check-label" for="exampleRadios2">
                                                  Americana
                                                </label>
                                              </div>
                                              <div class="form-check col">
                                                <input class="form-check-input" type="checkbox" name="exampleRadios" id="italiana" value="option2">
                                                <label class="form-check-label" for="exampleRadios2">
                                                  Italiana
                                                </label>
                                              </div>
                                            -->
                                </div>

                                <!--
                                        <div class="col-md-6">
                                            <input id="type" type="text" class="form-control @error('name') is-invalid @enderror" name="type" value="{{ old('type') }}" required autocomplete="type" autofocus>

                                            @error('Nome Attivita')
        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
    @enderror
                                        </div>
                                        -->
                            </div>



                            <!--  PASSWORD ATTIVITA'  -->
                            <div class="mb-4 row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!--  CONFERMA PASSWORD  -->
                            <div class="mb-4 row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Conferma
                                    Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-4 col-md-2">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary">
                                            Registrati
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-4 col-md-2">
                                    <div>
                                        <button type="reset" class="btn btn-danger">
                                            Cancella
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
