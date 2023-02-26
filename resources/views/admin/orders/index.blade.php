@extends('layouts.admin')

@section('title')

    | Ordini

@endsection

@section('content')

<div class="container-fluid">

    <div class="row row-cols-1 row-cols-md-2">

        @foreach ($orders as $order )

            <div class="col mb-3">
                <div class="card p-2 p-lg-4 h-100">
                    <div class="d-flex justify-content-between">
                        <h4>&euro;{{$order->total_price}}</h4>
                        <div class="d-flex flex-column align-items-end">
                            <small>{{date_format(date_create($order->created_at),'d/m/Y')}}</small>
                            <small>{{date_format(date_create($order->created_at),'H:m:s')}}</small>
                        </div>
                    </div>
                    <h5>{{$order->customer_name}} {{$order->customer_surname}}</h5>
                    <div>
                        <i class="fa-solid fa-bicycle me-1"></i>
                        <em>{{$order->customer_address}}</em>
                    </div>
                    <div class="mb-2">
                        <i class="fa-solid fa-phone me-1"></i>
                        <small>{{$order->customer_phone_number}}</small>
                    </div>
                    <small>{{$order->customer_note}}</small>
                    {{-- @dd($order->foods[0]->pivot->quantity) --}}

                    <div>
                        <h6>ORDINE</h6>
                        @foreach ($order->foods as $food )
                        <div></div>
                        <small>{{$food->name}}</small>
                        <smal>{{$food->pivot->quantity}}</small>

                        @endforeach
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

@endsection
