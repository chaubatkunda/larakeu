<x-app-layout title="Pemasukan - Larakeu">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Pemasukan</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{ route('pemasukan.create') }}" class="btn btn-outline-primary">
                    <span data-feather="plus"></span>
                    Tambah Pemasukan
                </a>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="alert alert-success border-0">
                <strong>Total Pemasukan :
                </strong>{{ rupiah($countPemasukan) }}
            </div>
            <div class="alert alert-info border-0">
                <strong>Total Keuangan :
                </strong>{{ rupiah($countPemasukan - $countPengeluaran) }}
            </div>
            <div>
                <a href="{{ route('pemasukan.cetak') }}" class="btn btn-primary" target="_blank">
                    <span data-feather="printer"></span> Cetak Pemasukan
                </a>
            </div>
        </div>

        <div class="card shadow-sm border-0 border-primary border-start">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Income</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

    @push('after-script')
        <script>
            $(document).ready(function() {
                $('#datatable').DataTable({
                    // pagingType: "first_last_numbers",
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    ajax: {
                        url: '{!! url()->current() !!}'
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'id'
                        },
                        {
                            data: 'price',
                            name: 'price'
                        },
                        {
                            data: 'keterangan',
                            name: 'keterangan'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        }
                    ]
                });
            });
        </script>
    @endpush
</x-app-layout>
