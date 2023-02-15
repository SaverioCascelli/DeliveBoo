@extends('layouts.admin')

@section('title')

    | Modifica piatto

@endsection

@section('content')

    <div class="container-fluid h-100 overflow-auto">

        <h1 class="mb-3">AGGIUNGI UN NUOVO PIATTO</h1>

        <!--  ************* Gestione lista degli errori ****************** -->
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
             </div>
        @endif

        <!-- ***************************** -->
        <!-- ********** Form ************* -->
         <!-- ***************************** -->
        <form action="{{route('admin.foods.update')}}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <!-- Nome del piatto -->
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                    value="{{old('name', $food->name)}}" placeholder="Inserisci il nome del piatto">
                @error('name')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>

            <!-- Descrizione -->
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description" value="{{old('description', $food->description)}}" placeholder="Inserisci la descrizione del piatto">
                @error('description')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>

            <!-- Prezzo -->
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo</label>
                <input type="number" min="0" step="any" name="price" class="form-control id="price" value="{{old('price', $food->price)}}" placeholder="Inserisci il prezzo del piatto">
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
                <input
                onchange="showImage(event)"
                type="file" name="img_url" class="form-control" id="img_url">
                @error('img_url')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror

                <div class="mt-2">
                    <img id="output-image" width="150" src="{{asset('storage/' . $food->img_url)}}" alt="{{$food->img_url_original_name}}">
                </div>

            </div>

            <button type="submit" class="btn btn-outline-success">MODIFICA</button>

        </form>

    </div>

    <script>

        function showImage(event){
            const tagImage = document.getElementById('output-image');
            tagImage.src = URL.createObjectURL(event.target.files[0]);
        }

    </script>

@endsection
