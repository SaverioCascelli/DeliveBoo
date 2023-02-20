@extends('layouts.admin')

@section('title')

    | Dashboard

@endsection

@section('content')

<div class="container-fluid h-100 overflow-auto">

    <div class="card col-12">

        <div class="card-header px-2 px-lg-4 d-flex align-items-center justify-content-between">
            <h3 class="mb-0">DASHBOARD</h3>
        </div>

        <div class="p-2 p-lg-4 bg-success">

            <div class="card p-2 p-lg-4 mb-2 mb-lg-4">

                <div class="row">

                    <div class="col-12 col-md-6">
                        <div class="image-restaurant me-3">
                            <img class="card-img-top "
                            src="{{$restaurant->img_url}}" alt="{{$restaurant->name}}">
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <h3>{{$restaurant->name}}</h3>
                        <h6>P.IVA: {{$restaurant->VAT}}</h6>
                        <p class="mb-0">{{$restaurant->address}}</p>

                        <p class="mb-3">
                            <span class="f-bold text-primary display-2">{{$availableFoods}}</span>
                            <strong class="display-4">/</strong>
                            <span class="display-6">{{$totalFoods}}</span>
                            <span>piatti disponibili</span>
                        </p>

                        <a class="btn btn-outline-primary btn-sm me-3" href="{{route('admin.foods.create')}}">
                            <i class="fa-solid fa-plus"></i>
                        </a>

                        <a class="btn btn-outline-primary btn-sm" href="{{route('admin.foods.index')}}">MENÙ</a>

                    </div>

                </div>

            </div>

            <div class="card p-2 p-lg-4 mb-2 mb-lg-4">

                <div class="row row-cols-1 row-cols-md-2">

                    @foreach ($latestOrders as $order)
                    <div class="p-2 col mb-2 mb-md-3">
                        <div class="order-card p-2">
                            <p class="mb-0 fw-bold">&euro;{{$order->total_price}}</p>
                            <p class="mb-0">{{$order->customer_name}}</p>
                            <p class="mb-0 fw-lighter">{{$order->customer_address}}</p>
                            <small class="mb-0">{{$order->customer_phone_number}}</small>
                        </div>
                    </div>
                    @endforeach

                </div>

                <div>
                    <a class="btn btn-outline-primary btn-sm me-3" href="{{route('admin.orders')}}">
                        MOSTRA
                        <i class="fa-solid fa-plus"></i>
                    </a>
                </div>

            </div>

            <div class="card p-2 p-lg-4">

                <div class="row row-cols-1 row-cols-md-2">

                    <div class="p-2 col mb-2 mb-md-3">
                        <div class="order-card p-2">
                            <h2>GRAFICO</h2>
                        </div>
                    </div>

                    <div class="p-2 col mb-2 mb-md-3">
                        <div class="order-card p-2">
                            <h2>GRAFICO</h2>
                        </div>
                    </div>


                </div>

                <div>
                    <a class="btn btn-outline-primary btn-sm me-3" href="{{route('admin.statistics')}}">
                        MOSTRA
                        <i class="fa-solid fa-plus"></i>
                    </a>
                </div>

            </div>











        </div>

    </div>

</div>

@endsection
