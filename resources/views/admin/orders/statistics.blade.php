@extends('layouts.admin')

@section('title')
    | Statistiche
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row row-cols-1 row-cols-md-2">

            <div class="col mb-3">
                <div class="card p-2 p-lg-4">
                    <h3>Ordini Ultimi 12 Mesi</h3>
                    <canvas id="myChartOne"></canvas>
                </div>
            </div>

            <div class="col mb-3">
                <div class="card p-2 p-lg-4">
                    <h3>Ordini Ultimo Mese</h3>
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
                    borderWidth: 1
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
                    backgroundColor: '#9BD0F5',
                    borderColor: '#36A2EB',
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
