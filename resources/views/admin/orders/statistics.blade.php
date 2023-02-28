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
        labels: ['Marzo 2022', 'Aprile 2022', 'Maggio 2022','Giugno 2022', 'Luglio 2022', 'Agosto 2022','Settembre 2022', 'Ottobre 2022', 'Novembre 2022','Dicembre 2022', 'Gennaio 2023', 'Febbraio 2023'],
        datasets: [{
            label: 'Fatturato in Euro',
            data: [7210, 7501, 6800, 7209, 8230, 4980, 5500, 6508, 6204, 15210, 11578, 9994],
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

const chartTwo =  document.getElementById('myChartTwo');

let myChartTwo = new Chart(chartTwo, {
    type: 'line',
    data: {
        labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31],
        datasets: [{
            label: 'Fatturato in Euro',
            data: [102, 102, 206, 250, 540, 991, 824, 548, 110, 250, 320, 450, 848, 704, 603, 150, 158, 369, 458, 780, 800, 480, 188, 206, 306, 600, 890, 958, 604, 178, 321],
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
