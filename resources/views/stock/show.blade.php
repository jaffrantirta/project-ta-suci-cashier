<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column h-full">
    <div class="container">
        <div class="card my-3">
            <div class="card-body">
                <h5 class="card-title">{{ env('NOTA_TITLE' ?? 'LARAVEL') }}</h5>
                <p class="card-text">{{ env('NOTA_DESCRIPTION' ?? 'LARAVEL DESC') }}</p>
            </div>
        </div>
        <div class="card my-5">
            <div class="card-header bg-primary text-white">Transaksi</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title">{{ $stock->number_of_invoice }}</h5>
                        <p class="card-text">{{ $stock->created_at }}</p>
                    </div>
                </div>

                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Barang</th>
                            <th>Jumlah Masuk</th>
                            <th>Satuan</th>
                            <th>Nama Supplier</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>{{ $stock->item->name }}</td>
                                <td>{{ $stock->change_amount }}</td>
                                <td>{{ $stock->item->item_unit->name }}</td>
                                <td>{{ $stock->supplier_name }}</td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- <script>
        // This script will trigger the print dialog once the page has loaded
        window.onload = function() {
            window.print(); // Opens the print dialog
        };
    </script> --}}
</body>
