<x-app-layout title="Member {{ $user->name }} Larakeu">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{ $user->name }}</h1>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 border-primary border-start">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Profit</th>
                                <td>{{ rupiah($user->incomes->sum('price')) }}</td>
                            </tr>
                            <tr>
                                @php
                                    $balance = $user->incomes->sum('price') - $user->expendirures->sum('price');
                                @endphp
                                <th>Balance</th>
                                <td class="{{ $balance >= 0 ? 'text-primary' : 'text-danger' }}">
                                    {{ rupiah($balance) }}
                                </td>
                            </tr>
                            <tr>
                                <th>Rugi</th>
                                <td class="text-danger">
                                    @php
                                        $a = $user->incomes->sum('price') - $user->expendirures->sum('price');
                                    @endphp
                                    {{ rupiah($user->incomes->sum('price') - $a) }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm border-0 border-primary border-end">
                    <div class="card-body">
                        <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @push('after-script')
        <script>
            /* globals Chart:false, feather:false */

            (function() {
                'use strict'
                // Graphs
                var ctx = document.getElementById('myChart')
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: <?= $terms ?>,
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
            })()
        </script>
    @endpush
</x-app-layout>
