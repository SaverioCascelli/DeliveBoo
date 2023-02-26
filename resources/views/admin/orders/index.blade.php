@extends('layouts.admin')

@section('title')

    | Ordini

@endsection

@section('content')

<div class="container-fluid">

    <div class="card p-2 p-lg-4 mb-2 mb-lg-4">

        <div class="row row-cols-1 row-cols-md-2">

            @foreach ($orders as $order )
                <div class="p-2 col mb-2 mb-md-3">
                    <div class="order-card h-100 p-2">
                        <div class="d-flex justify-content-between">
                            <h4 class="text-primary">&euro;{{$order->total_price}}</h4>
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
                                            <span class="order-price"> x &euro;{{$food->price}} = &euro;{{$food->pivot->quantity * $food->price}}</span>
                                        </small>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>

    <!-- pagination -->
    <div class="d-flex justify-content-center mt-1">
        {{$orders->links()}}
    </div>

</div>

@endsection
