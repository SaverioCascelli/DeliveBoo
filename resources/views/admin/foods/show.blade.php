@extends('layouts.admin')

@section('title')
    | Vista piatto
@endsection

@section('content')

<main>
    <div class="container-lg my-4 p-3">
        <div class="">

            <div class="card">
                <div class="row row-cols-1 row-cols-xs-1 flex-wrap-reverse row-cols-xl-2 d-flex justify-content-between">

                    <!--    NOME PIATTO/PREZZO -->
                    <div class="col p-3 px-5">
                        <div class="clearfix mb-3">
                            <h4 class="float-end">
                                4.00&euro;
                            </h4>
                            <h1 class="card-title">
                                Hamburger
                            </h1>
                        </div>
                        <div class="text-left my-3 d-flex justify-content-between">
                            <h3>Ingredienti:</h3>
                        </div>
                        <!--    INGREDIENTI -->
                        <div>
                            <p class="text-capitalize w-75 fs-5">
                                pane, carne bovina, formaggio, salsa big mac, insalata, cipolla, cetriolo.
                            </p>
                        </div>
                        <!--    /INGREDIENTI -->

                        <!--    BOTTONI FONTAWESOME -->
                        <div class="">
                            <div class="row">
                                <button type="button" class="col-2 mx-2 btn btn-success mt-1">
                                    <a class="text-white text-decoration-none" href="{{route('admin.foods.index')}}">
                                        TORNA AL MEN&Uacute;
                                    </a>
                                </button>
                                <button type="button" class="col mx-2 btn btn-warning mt-1">
                                    <a class="text-white text-decoration-none" href="#">
                                        MODIFICA
                                    </a>
                                </button>
                                <button type="button" class="col mx-2 btn btn-danger mt-1">
                                    <a href="" class="text-white text-decoration-none">ELIMINA</a>
                                </button>
                                <!--    PULSANTE ON/OFF -->
                                <div class=" col mx-2 form-check form-switch">
                                    <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                    <span>ON/OFF</span>
                                </div>
                                <!--    /PULSANTE ON/OFF -->

                            </div>
                        </div>
                        <!--    /BOTTONI FONTAWESOME -->

                    </div>

                    <div class="col">
                        <img src="https://www.mcdonalds.it/sites/default/files/styles/product_isolated_preview/public/products/big-mac-isolated.png" class="img w-75 m-auto d-block" alt="hamburger">
                    </div>
                </div>
            </div>

        </div>


    </div>
</main>


@endsection
