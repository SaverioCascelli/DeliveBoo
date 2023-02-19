@extends('layouts.admin')

@section('title')

    | Index

@endsection

@section('content')

<div class="container-fluid h-100 overflow-auto">

    <div class="card col-12 ">

        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="mb-0 ms-2">MENÙ</h3>
            <a class="btn btn-outline-primary me-2" href="{{route('admin.foods.create')}}">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>

        <div class="pt-2 ps-2 pe-2 pb-1 pt-lg-4 pe-lg-4 ps-lg-4 ">

            @if (session('deleted'))
                <div class="alert alert-primary" role="alert">
                    <strong>{{session('deleted')}}</strong>
                </div>
            @endif

            <div class="row row-cols-1 row-cols-md-2">

                <!-- 1 card -->
                @foreach ($foods as $food)
                <div class="col mb-2 mb-md-3">
                    <div class="card p-2 h-100 bg-success">

                        <div class="d-flex mb-2 ">

                            <!-- controllo immagini -->
                            @if (str_contains($food->img_url, 'http'))
                            <div class="food-image me-3">
                                <img class="card-img-top @if ($food->is_available == 0) food-not-available @endif"
                                src="{{$food->img_url}}" alt="{{$food->img_url_original_name}}" id="imageFood">
                            </div>
                            @else
                            <div class="food-image me-3">
                                <img class="card-img-top @if ($food->is_available == 0) food-not-available @endif"
                                src="{{asset('storage/' . $food->img_url)}}" alt="{{$food->img_url_original_name}}" id="imageFood">
                            </div>
                            @endif

                            <div>

                                <div>
                                    <h6 class="m-0 d-sm-none">{{ Str::limit(($food->name), 17, '...') }}</h6>
                                    <h6 class="m-0 d-none d-sm-block d-md-none">{{ Str::limit(($food->name), 47, '...') }}</h6>
                                    <h6 class="m-0 d-none d-md-block d-xl-none">{{ Str::limit(($food->name), 22, '...') }}</h6>
                                    <h6 class="m-0 d-none d-xl-block">{{ Str::limit(($food->name), 32, '...') }}</h6>
                                </div>

                                <!-- controllo lunghezza testi -->
                                <div>

                                    <small class="m-0 d-sm-none">{{ Str::limit(($food->description), 17, '...') }}</small>
                                    <small class="m-0 d-none d-sm-block d-md-none">{{ Str::limit(($food->description), 47, '...') }}</small>
                                    <small class="m-0 d-none d-md-block d-xl-none">{{ Str::limit(($food->description), 22, '...') }}</small>
                                    <small class="m-0 d-none d-xl-block">{{ Str::limit(($food->description), 32, '...') }}</small>

                                </div>

                            </div>

                        </div>

                        <div class="bg-primary d-flex align-items-center justify-content-between p-2 rounded-2">

                            <h5 class="text-white font-bold ms-1 mb-0">
                                <span class="text-success">&euro;</span>{{$food->price}}
                            </h5>

                            <div class="py-1 px-2 bg-success rounded-2">

                                @include('admin.partials.form-update' ,[
                                'route' => 'foods',
                                'entity' => $food
                                ])

                            </div>

                            <div class="d-flex align-items-center h-100">
                                <a class="btn btn-outline-success btn-sm me-1" href="{{route('admin.foods.show', $food)}}">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a class="btn btn-outline-success btn-sm me-1" href="{{route('admin.foods.edit', $food)}}">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>

                                @include('admin.partials.form-delete' ,[
                                'route' => 'foods',
                                'message' => "Confermi l'eliminazione del piatto: $food->name",
                                'entity' => $food
                                ])

                            </div>

                        </div>

                    </div>
                </div>
                @endforeach

            </div>

        </div>

    </div>

</div>

@endsection
