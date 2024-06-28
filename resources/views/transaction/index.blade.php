@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card">
                <div class="card-header">Transaksi</div>

                <div class="card-body">
                    <form action="{{ route('transaction.index') }}" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" id="searchInput" class="form-control" placeholder="Kode nota..."
                                name="filter[number]">
                            <input type="date" id="dateStartSearchInput" class="form-control" placeholder="Tanggal Awal"
                                name="filter[created_at][start]">
                            <input type="date" id="dateEndSearchInput" class="form-control" placeholder="Tanggal Akhir"
                                name="filter[created_at][end]">
                            <button type="submit" class="btn btn-outline-secondary">Search</button>
                        </div>
                    </form>
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
                            @foreach($transactions as $key => $transaction)
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
<script>
</script>
@endsection
