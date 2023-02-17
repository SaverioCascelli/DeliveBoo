@extends('layouts.admin')

@section('title')

    | Registrazione

@endsection

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registrazione</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Nome utente -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" placeholder="Inserisci il tuo nome">
                                {{-- errore client --}}
                                <p id="registerName" class="invalid-feedback d-none"></p>
                                {{-- errore server --}}
                                @error('name')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>

                            <!-- Email utente -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" placeholder="Inserisci la tua email">
                                {{-- errore client --}}
                                <p id="registerEmail" class="invalid-feedback d-none"></p>
                                {{-- errore server --}}
                                @error('email')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>

                            <!-- Nome ristorante-->
                            <div class="mb-3">
                                <label for="restaurantName" class="form-label">Nome ristorante</label>
                                <input id="restaurantName" type="text"
                                    class="form-control @error('restaurantName') is-invalid @enderror"
                                    name="restaurantName" value="{{ old('restaurantName') }}" placeholder="Inserisci il nome del ristorante">
                                {{-- errore client --}}
                                <p id="registerRestaurantName" class="invalid-feedback d-none"></p>
                                {{-- errore server --}}
                                @error('restaurantName')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>

                            <!-- Partita iva -->
                            <div class="mb-3">
                                <label for="piva" class="form-label">Partita IVA</label>
                                <input id="piva" type="text"
                                    class="form-control @error('piva') is-invalid @enderror" name="piva"
                                    value="{{ old('piva') }}" placeholder="Inserisci la Partita Iva">
                                {{-- errore client --}}
                                <p id="registerPiva" class="invalid-feedback d-none"></p>
                                {{-- errore server --}}
                                @error('piva')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>


                            <!-- Indirizzo -->
                            <div class="mb-3">
                                <label for="address" class="form-label">Indirizzo ristorante</label>
                                <input id="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror" name="address"
                                    value="{{ old('address') }}" placeholder="Inserisci l'indirizzo del ristorante">
                                {{-- errore client --}}
                                <p id="registerAddress" class="invalid-feedback d-none"></p>
                                {{-- errore server --}}
                                @error('address')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
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

                                </div>
                            </div>



                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    placeholder="Inserisci la password">
                                {{-- errore client --}}
                                <p id="registerPassword" class="invalid-feedback d-none"></p>
                                {{-- errore server --}}
                                @error('password')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>

                            <!-- Conferma Password -->
                            <div class="mb-3">
                                <label for="passwordConfirm" class="form-label">Conferma password</label>
                                <input id="passwordConfirm" type="password"
                                    class="form-control @error('passwordConfirm') is-invalid @enderror"
                                    name="passwordConfirm" placeholder="Inserisci la password">
                                {{-- errore client --}}
                                <p id="registerPasswordConfirm" class="invalid-feedback d-none"></p>
                                {{-- errore server --}}
                                @error('passwordConfirm')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
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
