@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Detail Transaction</div>
        <div class="card-body">
            <p class="card-text"><strong>Invoice Number:</strong> {{ $transaction->number }}</p>
            <p class="card-text"><strong>Created At:</strong> {{ $transaction->created_at }}</p>
            <p class="card-text"><strong>Customer Name:</strong> {{ $transaction->customer_name }}</p>
            <p class="card-text"><strong>Customer Address:</strong> {{ $transaction->customer_address  }}</p>

            <p class="card-text"><strong>Total Amount:</strong> {{ number_format($transaction->total_of_item) }}</p>
            <p class="card-text"><strong>Jumlah Total:</strong> Rp.{{ number_format($transaction->total_of_amount) }}</p>
            @if($transaction->transaction_details->count())
                <table class="table table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
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



