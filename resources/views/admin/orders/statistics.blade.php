@extends('layouts.admin')

@section('title')
    | Statistiche
@endsection

@section('content')
    <div class="container-fluid">

        <div class="container-fluid">

            <div class="card ">

                <div class="card-header px-2 px-lg-4 d-flex align-items-center justify-content-between">
                    <h3 class="mb-0">REPORT</h3>
                </div>

                <div class="pt-2 ps-2 pe-2 pb-1 pt-lg-4 pe-lg-4 ps-lg-4">

                    <div class="row row-cols-1">

                        <div class="col mb-3">
                            <div class="card p-2 p-lg-4">
                                <h4>ORDINI 2023</h4>
                                <canvas id="myChartOne"></canvas>
                            </div>
                        </div>

                        <div class="col mb-3">
                            <div class="card p-2 p-lg-4">
                                <h3>ORDINI ULTIMO MESE</h3>
                                <canvas id="myChartTwo"></canvas>
                            </div>
                        </div>

                        {{-- <div class="col mb-3">
                            <div class="card p-2 p-lg-4">
                                <h3>Piatto più venduto</h3>
                                <canvas id="myChartThree"></canvas>
                            </div>
                        </div> --}}

                        {{-- <div class="col mb-3">
                            <div class="card p-2 p-lg-4">
                                <h3>Grafico 4</h3>
                                <canvas id="myChartFour"></canvas>
                            </div>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>

    </div>


    <script>
        /* -------- GRAFICO 1 ---------*/

        const chartOne = document.getElementById('myChartOne');

        let myChartOne = new Chart(chartOne, {
            type: 'bar',
            data: {
                labels: @json($monthNames),
                datasets: [{
                    label: 'Fatturato in Euro',
                    data: @json($ordersInYear),
                    borderWidth: 1,
                    backgroundColor: '#00ccbc',
                    borderColor: '#00ccbc',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, ticks) {
                                return '€' + value;
                            }
                        }
                    }
                }
            }
        });


        /* -------- GRAFICO 2 ---------*/

        const chartTwo = document.getElementById('myChartTwo');

        let myChartTwo = new Chart(chartTwo, {
            type: 'line',
            data: {
                labels: @json($daysInMonth),
                datasets: [{
                    label: 'Fatturato in Euro',
                    data: @json($orderInMonth),
                    borderWidth: 1,
                    backgroundColor: '#D0EB99',
                    borderColor: '#D0EB99',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, ticks) {
                                return '€' + value;
                            }
                        }
                    }
                }
            }
        });


        /* -------- GRAFICO 3 ---------*/

        /*
        const three = document.getElementById('myChartThree');

        let myChartThree = new Chart(three, {
            type: 'bar',
            data: {
                labels: ['Uno', 'Due', 'Tre', 'Quattro', 'Cinque'],
                datasets: [{
                    label: 'Numero di Ordini',
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        */

        /* -------- GRAFICO 4 ---------*/

        /*
        const four = document.getElementById('myChartFour');

        let myChartFour = new Chart(four, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        */
    </script>
@endsection
