<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- datatables --}}
    <link rel="stylesheet" href="{{ asset('datatables/datatables.min.css') }}">

</head>

<body>
    <header class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow-sm">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="{{ route('dashboard') }}">Lara'keu</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </header>
    <div class="container-fluid">
        <div class="row">
            @include('layouts.navigation')
            {{ $slot }}
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('datatables/datatables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
        integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
    </script>
    @include('sweetalert::alert')

    @stack('after-script')
</body>

</html>
