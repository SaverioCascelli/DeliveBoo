@extends('layouts.admin')

@section('title')

    | Registrazione

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">

                    <div class="card-header">
                        <h6 class="mb-0">Registrazione</h6>
                        <small>I campi contrassegnati con * sono obbligatori</small>
                    </div>

                    <div class="card-body">

                        <!--  ************* Gestione lista degli errori server ****************** -->
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert" id="errorServerRegister">
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
                        <form method="POST" action="{{ route('register') }}" id="userRegister">
                            @csrf

                            <!-- Nome utente -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome *</label>
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
                                <label for="email" class="form-label">Email *</label>
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
                                <label for="restaurantName" class="form-label">Nome ristorante *</label>
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
                                <label for="piva" class="form-label">Partita IVA *</label>
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
                                <label for="address" class="form-label">Indirizzo ristorante *</label>
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

                            <!-- Tipologia cucina -->
                            <div class="mb-3 ">
                                <label class="form-label mb-0">Tipologia di cucina *</label>
                                <small class="d-block mb-2">Inserisci una o più tipologie di cucina</small>

                                <div class="row row-cols-2">
                                    @foreach ($types as $type)
                                    <div class="col">
                                        <input type="checkbox"
                                            id="type{{$loop->iteration}}"
                                            name="types[]"
                                            value="{{$type->id}}"
                                            @if (in_array($type->id, old('types',[])))
                                                checked
                                            @endif>
                                            <label class="me-2" for="type{{$loop->iteration}}">{{$type->name}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password *</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}"
                                    placeholder="Inserisci la password">
                                {{-- errore client --}}
                                <p id="registerPassword" class="invalid-feedback d-none"></p>
                                {{-- errore server --}}
                                @error('password')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>

                            <!-- Conferma Password -->
                            <div class="mb-4">
                                <label for="password-confirm" class="form-label">Conferma password *</label>
                                <input id="password-confirm" type="password"
                                    class="form-control @error('password-confirm') is-invalid @enderror"
                                    name="password_confirmation" placeholder="Inserisci la password" value="{{ old('password_confirmation') }}">
                                {{-- errore client --}}
                                <p id="registerPasswordConfirm" class="invalid-feedback d-none"></p>
                                {{-- errore server --}}
                                @error('password-confirm')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary text-white px-4">Registrati</button>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
