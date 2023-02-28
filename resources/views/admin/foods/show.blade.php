@extends('layouts.admin')

@section('title')
    | Dettaglio piatto
@endsection

@section('content')

<div class="container-fluid h-100 overflow-auto">

    <div class="card col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">

        <div class="card-header px-2 px-lg-4 d-flex align-items-center justify-content-between">
            <h3 class="mb-0">INFO PIATTO</h3>
            <div>

                <a class="btn btn-outline-primary btn-sm me-1" href="{{route('admin.foods.index')}}">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <a class="btn btn-outline-primary btn-sm me-1" href="{{route('admin.foods.edit', $food)}}">
                    <i class="fa-solid fa-pencil"></i>
                </a>

                @include('admin.partials.form-delete' ,[
                    'route' => 'foods',
                    'message' => "Confermi l'eliminazione del piatto: $food->name",
                    'entity' => $food
                    ])

            </div>
        </div>

        <div class="p-2 p-lg-4">

            @if (session('message'))
                <div class="alert alert-primary" role="alert">
                    <strong>{{session('message')}}</strong>
                </div>
            @endif

            <h3>{{$food->name}}</h3>
            <h4>&euro;{{number_format($food->price,2,',','.')}}</h4>
            <p>{{$food->description}}</p>

            <!-- controllo immagini -->
            @if (str_contains($food->img_url, 'http'))
                <div class="food-image-show p-0">
                    <img src="{{$food->img_url}}" alt="{{$food->img_url_original_name}}">
                </div>
            @else
                <div class="food-image-show p-0">
                    <img src="{{asset('storage/' . $food->img_url)}}" alt="{{$food->img_url_original_name}}">
                </div>
            @endif

        </div>

    </div>


</div>




@endsection
