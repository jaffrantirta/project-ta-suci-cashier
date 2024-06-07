@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @can('stock.create')
                <a href="{{ route('stock.create') }}" class="btn btn-primary mb-2">Tambah</a>
            @endcan
            <div class="card">
                <div class="card-header">Stok barang</div>

                <div class="card-body">
                    <form action="{{ route('stock.index') }}" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="search" id="searchInput" class="form-control" placeholder="Cari berdasarkan nama barang..." name="filter[item.name]">
                            <button type="submit" class="btn btn-outline-secondary">Search</button>
                        </div>
                    </form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Jumlah total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stocks as $key => $stock)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $stock->item->name }}</td>
                                    <td class="{{ $stock->change_amount > 0 ? 'text-success' : ($stock->change_amount < 0 ? 'text-danger' : '') }}">
                                        {{ $stock->change_amount }} {{ $stock->item->unit_of_stock }}
                                    </td>
                                    <td>{{ $stock->amount }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-secondary mt-2" href="{{ route('stock.show', ['stock' => $stock->id]) }}">Lihat</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $stocks->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
</script>
@endsection
