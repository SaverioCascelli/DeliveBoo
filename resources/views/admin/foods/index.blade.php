@extends('layouts.admin')

@section('title')

    | Index

@endsection

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">

                <div class="card-header d-flex align-items-center">
                    <h1 class="m-0 mt-3">Menù</h1>
                    <div class="mt-4 mx-5">
                        <button type="button" class="btn btn-success ">
                            <a class="text-white text-decoration-none" href="{{route('admin.foods.create')}}"><i class="fa-solid fa-plus"></i></a>
                        </button>
                    </div>
                </div>

                <div>
                    <div class="container-xl my-4 p-3">

                        <div class="row row-cols-1 row-cols-xs-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">

                            <!-- 1 card -->
                            @foreach ($foods as $food)
                            <div class="col col-sm-6 col-md-4 col-lg-4 col-xl-3">
                                <div class="card h-100">
                                    <!--    IMMAGINE -->

                                    @if (str_contains($food->img_url, 'http'))
                                    <div class="m-auto py-2 ft-img">
                                        <img class="card-img-top m-auto rounded" src="{{$food->img_url}}" alt="{{$food->img_url_original_name}}">
                                    </div>
                                    @else
                                    <div class="m-auto py-2 ft-img">
                                        <img class="card-img-top m-auto rounded" src="{{asset('storage/' . $food->img_url)}}" alt="{{$food->img_url_original_name}}">
                                    </div>
                                    @endif
                                    <!--    NOME PIATTO/PREZZO -->
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-3">
                                            <h5 class="card-title">
                                                    {!! Str::limit(($food->name), 14, '..') !!}
                                            </h5>
                                            <span class="">
                                                {{$food->price}}&euro;
                                            </span>
                                        </div>
                                        <div class="text-left my-1 d-flex justify-content-between text-style-none">
                                            <h6>Ingredienti:</h6>


                                            <!--    PULSANTE ON/OFF -->
                                            <!--
                                            <div class="form-check form-switch">
                                                <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                            </div>  -->

                                            <!--    /PULSANTE ON/OFF -->

                                        </div>

                                        <!--    INGREDIENTI -->
                                        <div>
                                            <p class="text-capitalize w-75 h-25" id="demo">
                                                {!! Str::limit(($food->description), 25, '...') !!}
                                            </p>
                                        </div>
                                        <!--    /INGREDIENTI -->

                                        <!--    BOTTONI FONTAWESOME -->
                                        <div class="w-100">
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-info mt-1">
                                                    <a class="text-white text-decoration-none" href="{{route('admin.foods.show', $food)}}"><i class="fa-solid fa-eye"></i></a>
                                                </button>
                                                <button type="button" class="btn btn-warning mt-1">
                                                    <a class="text-white text-decoration-none" href="{{route('admin.foods.edit', $food)}}"><i class="fa-solid fa-pencil"></i></a>
                                                </button>

                                                <button type="button" class="btn btn-danger mt-1">
                                                    <a href="#" class="text-white text-decoration-none"><i class="fa-solid fa-trash"></i></a>
                                                </button>
                                            </div>
                                        </div>
                                        <!--    /BOTTONI FONTAWESOME -->

                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>


                    </div>
                </div>
        </div>
    </div>
</div>



@endsection
