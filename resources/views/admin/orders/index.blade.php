@extends('layouts.admin')

@section('title')

    | Ordini

@endsection

@section('content')

<div class="container-fluid">

    <div class="card ">

        <div class="card-header px-2 px-lg-4 d-flex align-items-center justify-content-between">
            <h3 class="mb-0">ORDINI</h3>
        </div>

        <div class="pt-2 ps-2 pe-2 pb-1 pt-lg-4 pe-lg-4 ps-lg-4">

            <div class="row row-cols-1 row-cols-md-2">

                @foreach ($orders as $order )
                    <div class="p-2 col mb-2 mb-md-3">
                        <div class="order-card h-100 p-2">
                            <div class="d-flex justify-content-between">
                                <h4 class="text-primary">&euro;{{number_format($order->total_price, 2, ',', '.')}}</h4>
                                <div class="d-flex flex-column align-items-end">
                                    <small>{{date_format(date_create($order->created_at),'d/m/Y')}}</small>
                                    <small>{{date_format(date_create($order->created_at),'H:m:s')}}</small>
                                </div>
                            </div>
                            <h5 class="mb-0">{{$order->customer_name}} {{$order->customer_surname}}</h5>
                            <div>
                                <i class="fa-solid fa-bicycle me-1"></i>
                                <em>{{$order->customer_address}}</em>
                            </div>
                            <div class="mb-2">
                                <i class="fa-solid fa-phone me-1"></i>
                                <small>{{$order->customer_phone_number}}</small>
                            </div>
                            <small>{{$order->customer_note}}</small>
                            <div class="order-detail m-2 rounded-2 p-3">
                                <h6 class="fw-bold">ORDINE</h6>
                                <ul class="ps-0 mb-0">
                                    @foreach ($order->foods as $food)
                                        <li class="d-flex justify-content-between">
                                            <small>{{$food->name}}</small>
                                            <smal>
                                                <span class="text-danger fw-bold">{{$food->pivot->quantity}}</span>
                                                <span class="order-price d-none d-sm-inline"> x &euro;{{number_format($food->price,2,',','.')}} = &euro;{{number_format($food->pivot->quantity * $food->price, 2,',','.')}}</span>
                                            </small>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- pagination -->
            <div class="d-flex justify-content-center mt-1">
                {{$orders->links()}}
            </div>

        </div>

    </div>

</div>

@endsection
