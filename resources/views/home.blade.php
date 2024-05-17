@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Transaksi Hari Ini</div>

                <div class="card-body">
                    <h4 class="card-title">
                        <strong>{{ $transactionsToday }}</strong>
                    </h4>
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bestSeller as $item)
                            <tr>
                                <td>{{ $item->item->name }}</td>
                                <td>{{ abs($item->quantity) }} {{ $item->item->unit_of_stock }}</td>
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
