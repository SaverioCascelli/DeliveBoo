@extends('layouts.admin')

@section('title')

    | Index

@endsection

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="">
                <div class="card-header">
                    <h2 class="m-0 mt-3">Menù</h2>
                </div>

                <main>
                    <div class="container-xl my-4 p-3">

                        <div class="row row-cols-1 row-cols-xs-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">

                            <!-- 1 card -->
                            <div class="col col-md-6 col-lg-4 col-xl-3">
                                <div class="card">

                                    <img src="https://www.mcdonalds.it/sites/default/files/styles/product_isolated_preview/public/products/big-mac-isolated.png" class="card-img-top w-75 m-auto" alt="hamburger">

                                    <!--    NOME PIATTO/PREZZO -->
                                    <div class="card-body">
                                        <div class="clearfix mb-3">
                                            <span class="float-end">
                                                4.00&euro;
                                            </span>
                                            <h5 class="card-title">
                                                Hamburger
                                            </h5>
                                        </div>
                                        <div class="text-left my-1 d-flex justify-content-between">
                                            <h6>Ingredienti:</h6>


                                            <!--    PULSANTE ON/OFF -->
                                            <div class="form-check form-switch">
                                                <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                            </div>
                                            <!--    /PULSANTE ON/OFF -->

                                        </div>

                                        <!--    INGREDIENTI -->
                                        <div>
                                            <p class="text-capitalize w-50">
                                                pane, carne bovina, formaggio, salsa big mac, insalata, cipolla, cetriolo.
                                            </p>
                                        </div>
                                        <!--    /INGREDIENTI -->

                                        <!--    BOTTONI FONTAWESOME -->
                                        <div class="w-100">
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-info mt-1">
                                                    <a class="text-white text-decoration-none" href="#"><i class="fa-solid fa-eye"></i></a>
                                                </button>
                                                <button type="button" class="btn btn-warning mt-1">
                                                    <a class="text-white text-decoration-none" href="#"><i class="fa-solid fa-pencil"></i></a>
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

                        </div>


                    </div>
                </main>
            </div>
        </div>
    </div>
</div>

@endsection
