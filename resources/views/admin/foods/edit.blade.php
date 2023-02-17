@extends('layouts.admin')

@section('title')

    | Modifica piatto

@endsection

@section('content')

    <div class="container-fluid h-100 overflow-auto">

        <h1 class="mb-3">MODIFICA INFORMAZIONI PIATTO</h1>

        <!--  ************* Gestione lista degli errori server ****************** -->
        @if ($errors->any())
            <div class="alert alert-danger" role="alert" id="errorServer">
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
        <form action="{{route('admin.foods.update', $food)}}" method="POST" enctype="multipart/form-data" id="foodFormEdit">

            @csrf
            @method('PUT')

            <!-- Nome piatto -->
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                    value="{{old('name', $food->name)}}" placeholder="Inserisci il nome del piatto">
                {{-- errore client --}}
                <p id="foodName" class="invalid-feedback d-none"></p>
                {{-- errore server --}}
                @error('name')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>

            <!-- Descrizione -->
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Inserisci la descrizione del piatto">{{old('description', $food->description)}}</textarea>
                {{-- errore client --}}
                <p id="foodDescription" class="invalid-feedback d-none"></p>
                {{-- errore server --}}
                @error('description')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>

            <!-- Prezzo -->
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo</label>
                <input type="number" min="0" step="any" name="price" class="form-control @error('price') is-invalid @enderror" id="price" value="{{old('price', $food->price)}}" placeholder="Inserisci il prezzo del piatto">
                {{-- errore client --}}
                <p id="foodPrice" class="invalid-feedback d-none"></p>
                {{-- errore server --}}
                @error('price')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>

            <!-- Disponibilità -->
            <label class="form-label">Disponibilità</label>
            <div class="mb-3 d-flex">
                <div class="form-check me-5">
                    <input class="form-check-input" type="radio" name="is_available" id="available" value="1"
                        @if (!$errors->all() && $food->is_available == '1')
                            checked
                        @elseif ($errors->all() && old('is_available') == '1')
                            checked
                        @endif >
                    <label class="form-check-label" for="available">
                        Disponibile
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_available" id="not_available" value="0"
                        @if (!$errors->all() && $food->is_available == '0')
                            checked
                        @elseif ($errors->all() && old('is_available') == '0')
                            checked
                        @endif>
                    <label class="form-check-label" for="not_available">
                    Non disponibile
                    </label>
                </div>
            </div>

            <!-- Immagine -->
            <div class="mb-3">
                <label for="img_url" class="form-label">Immagine</label>
                <input type="file" name="img_url" class="form-control @error('img_url') is-invalid @enderror" id="img_url">
                {{-- errore client --}}
                <p id="foodImage" class="invalid-feedback d-none mb-1"></p>
                {{-- errore server --}}
                @error('img_url')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror

                @if (str_contains($food->img_url, 'http'))
                    <div class="mt-2">
                        <img id="output-image" width="150" src="{{$food->img_url}}" alt="{{$food->img_url_original_name}}">
                    </div>
                @else
                    <div class="mt-2">
                        <img id="output-image" width="150" src="{{asset('storage/' . $food->img_url)}}" alt="{{$food->img_url_original_name}}">
                    </div>
                @endif

            </div>

            <button type="submit" class="btn btn-outline-success">MODIFICA</button>

        </form>

    </div>

@endsection
