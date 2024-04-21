@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Detail Transaction</div>
        <div class="card-body">
            <p class="card-text"><strong>Nomor Invoice:</strong> {{ $transaction->number }}</p>
            <p class="card-text"><strong>Tanggal transaksi:</strong> {{ $transaction->created_at }}</p>
            <p class="card-text"><strong>Nama customer:</strong> {{ $transaction->customer_name }}</p>
            <p class="card-text"><strong>Alamat customer:</strong> {{ $transaction->customer_address  }}</p>

            <p class="card-text"><strong>Total barang:</strong> {{ number_format($transaction->total_of_item) }}</p>
            <p class="card-text"><strong>Jumlah total:</strong> Rp.{{ number_format($transaction->total_of_amount) }}</p>
            @if($transaction->transaction_details->count())
                <table class="table table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>Nama barang</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction->transaction_details as $detail)
                            <tr>
                                <td>{{ $detail->item_name }}</td>
                                <td>Rp.{{ number_format($detail->item_price) }}</td>
                                <td>{{ number_format($detail->amount) }}</td>
                                <td>Rp.{{ number_format($detail->total) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection



