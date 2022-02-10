<x-app-layout title="Tambahkan Pemasukan - Larakeu">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Pemasukan</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{ route('pemasukan.index') }}" class="btn btn-outline-primary">
                    <span data-feather="arrow-left-circle"></span>
                    Kembali
                </a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 border-primary border-start">
                    <div class="card-body">
                        <form action="{{ route('pemasukan.store') }}" method="post">
                            @csrf
                            @include('pages.uang-masuk._form-control')
                            <hr>
                            <div class="mb-3">
                                <x-button> <span data-feather="save"></span> Simpan</x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
