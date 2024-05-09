@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">Barang terlaris</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bestSeller as $item)
                            <tr>
                                <td>{{ $item->item->name }}</td>
                                <td>{{ abs($item->quantity) }}</td>
                                <td>{{ $item->item->unit_of_stock }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">Transaksi Hari Ini</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Transaksi</th>
                                <th>Jumlah Total</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactionsToday as $key => $transaction)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        <a href="{{ route('transaction.show', ['transaction' => $transaction->id, 'include[]' => 'transaction_details']) }}">
                                            {{ $transaction->number }}
                                        </a>
                                    </td>

                                    <td>Rp{{ number_format($transaction->total_of_amount) }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
