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
        <div class="card my-5">
            <div class="card-header bg-primary text-white">Receipt Transaction</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title">{{ $transaction->number }}</h5>
                        <p class="card-text">{{ $transaction->created_at }}</p>
                    </div>
                </div>

                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction->transaction_details as $detail)
                            <tr>
                                <td>{{ $detail->item_name }}</td>
                                <td>{{ $detail->amount }}</td>
                                <td>Rp.{{ number_format($detail->item_price) }}</td>
                                <td>Rp.{{ number_format($detail->total) }}</td>
                            </tr>
                        @endforeach
                        <tr class="table-dark">
                            <th colspan="3" class="text-end">Jumlah Total</th>
                            <td>Rp.{{ number_format($transaction->total_of_amount) }}</td>
                        </tr>
                        @if ($transaction->downpayment)
                            <tr class="table-dark">
                                <th colspan="3" class="text-end">Down Payment</th>
                                <td>{{ number_format($transaction->downpayment) }}</td>
                            </tr>
                        @endif
                        @if ($transaction->payment > 0)
                            <tr class="table-dark">
                                <th colspan="3" class="text-end">Payment</th>
                                <td>{{ number_format($transaction->payment) }}</td>
                            </tr>
                        @endif
                        @if ($transaction->change < 0)
                            <tr class="table-dark">
                                <th colspan="3" class="text-end">Change</th>
                                <td>{{ number_format($transaction->change) }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>


                <table class="table">
                    <thead>
                        <tr>
                            <th>Payment Method</th>
                            <th>Pay Amount</th>
                            <th>Change Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $transaction->payment_method == '1' ? 'Cash' : 'Transfer' }}</td>
                            <td>Rp.{{ number_format($transaction->pay_amount) }}</td>
                            <td>Rp.{{ number_format($transaction->change_amount) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // This script will trigger the print dialog once the page has loaded
        window.onload = function() {
            window.print(); // Opens the print dialog
        };
    </script>
</body>
