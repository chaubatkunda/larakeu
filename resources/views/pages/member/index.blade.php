<x-app-layout title="Member - Larakeu">
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

        <div class="card shadow-sm border-0 border-primary border-start">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Pemasukan</th>
                                <th scope="col">Pengeluaran</th>
                                <th scope="col">Balance</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <th>{{ $index + 1 }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ rupiah($ru = $user->incomes->sum('price') - $user->expendirures->sum('price')) }}
                                    </td>
                                    <td>{{ rupiah($user->expendirures->sum('price')) }}</td>
                                    <td>{{ rupiah($ru) }}</td>
                                    <td>
                                        <a href="{{ route('member.show', $user) }}"
                                            class="btn btn-sm btn-primary">Show</a>
                                    </td>
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
