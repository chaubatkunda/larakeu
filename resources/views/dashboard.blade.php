<x-app-layout title="Dashboard - Larakeu">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
        </div>

        <div class="row">
            @can('admin')
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card border-0 shadow-sm bg-primary text-white">
                                <div class="card-body" data-bs-toggle="tooltip"
                                    title="Laporan Profit setiap bulan berjalan">
                                    <div class="card-caption">
                                        <strong>Profit</strong>
                                    </div>
                                    <div class="card-text">
                                        {{ rupiah($profit) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card border-0 shadow-sm bg-info text-white">
                                <div class="card-body" data-bs-toggle="tooltip"
                                    title="Laporan Balance setiap bulan berjalan">
                                    <div class="card-caption">
                                        <strong>Balance</strong>
                                    </div>
                                    <div class="card-text">
                                        {{ rupiah($balance) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm bg-danger text-white">
                                <div class="card-body" data-bs-toggle="tooltip"
                                    title="Laporan Rugi setiap bulan berjalan">
                                    <div class="card-caption">
                                        <strong>Rugi</strong>
                                    </div>
                                    <div class="card-text">
                                        {{ rupiah($rugi) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <figure class="figure">
                        <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
                        <figcaption class="figure-caption">Grafik Keuangan Bulan Berjalan</figcaption>
                    </figure>
                </div>
            @endcan
            @if (auth()->user()->role == 'MEMBER')
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm bg-primary text-white">
                        <div class="card-body">
                            <div class="card-caption">
                                <strong>Profit</strong>
                            </div>
                            <div class="card-text">
                                {{ rupiah(Auth::user()->incomes->sum('price')) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm bg-info text-white">
                        <div class="card-body">
                            <div class="card-caption">
                                <strong>Balance</strong>
                            </div>
                            <div class="card-text">
                                {{ rupiah($rg = Auth::user()->incomes->sum('price') - Auth::user()->expendirures->sum('price')) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm bg-danger text-white">
                        <div class="card-body">
                            <div class="card-caption">
                                <strong>Rugi</strong>
                            </div>
                            <div class="card-text">
                                {{ rupiah(Auth::user()->incomes->sum('price') - $rg) }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <hr>

    </main>

    @push('after-script')
        <script>
            /* globals Chart:false, feather:false */

            $(document).ready(function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
                'use strict'
                // Graphs
                var ctx = document.getElementById('myChart')
                // eslint-disable-next-line no-unused-vars
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: <?= $laps ?>,
                        datasets: [{
                            data: {{ $data }},
                            lineTension: 0,
                            backgroundColor: 'transparent',
                            borderColor: '#007bff',
                            borderWidth: 4,
                            pointBackgroundColor: '#007bff'
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: false
                                }
                            }]
                        },
                        legend: {
                            display: false
                        }
                    }
                })
            })
        </script>
    @endpush

    @push('after-script')
        <script>
            $(document).ready(function() {
                $('#datatable').DataTable();
            });
        </script>
    @endpush
</x-app-layout>
