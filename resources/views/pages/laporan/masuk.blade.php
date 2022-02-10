<x-app-layout title="Dashboard - Larakeu">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                    <span data-feather="calendar"></span>
                    This week
                </button>
            </div>
        </div>
        <div class="card mb-3 border-0">
            <div class="card-body">
                <form action="{{ route('laporan.masuk') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="date" name="awal" class="form-control">
                        <input type="date" name="akhiw" class="form-control">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Income</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($incomes as $index => $income)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ tanggal($income->created_at) }}</td>
                                    <td>{{ rupiah($income->price) }}</td>
                                    <td>{{ $income->keterangan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    @push('after-script')
        <script>
            $(document).ready(function() {
                $('#datatable').DataTable();
            });
        </script>
    @endpush
</x-app-layout>
