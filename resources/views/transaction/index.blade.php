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
                            <input type="search" id="searchInput" class="form-control" placeholder="Cari berdasarkan kode nota..." name="filter[number]">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Kode Transaksi</th>
                                <th>Jumlah Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $key => $transaction)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                    <td>{{ $transaction->number }}</td>
                                    <td>Rp{{ number_format($transaction->total_of_amount) }}</td>
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
