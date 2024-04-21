@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <a href="{{ route('stock.create') }}" class="btn btn-primary mb-2">Tambah</a>
            <div class="card">
                <div class="card-header">Stok barang</div>

                <div class="card-body">
                    <form action="{{ route('stock.index') }}" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="search" id="searchInput" class="form-control" placeholder="Cari berdasarkan nama barang..." name="filter[item.name]">
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
                                <th>Kode barang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Jumlah Stok Akhir</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stocks as $key => $stock)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $stock->created_at }}</td>
                                    <td>{{ $stock->item->sku }}</td>
                                    <td>{{ $stock->item->name }}</td>
                                    <td class="{{ $stock->change_amount > 0 ? 'text-success' : ($stock->change_amount < 0 ? 'text-danger' : '') }}">
                                        {{ $stock->change_amount }}
                                    </td>
                                    <td>{{ $stock->amount }}</td>
                                    <td>
                                        @if ($stock->change_amount > 0)
                                            Stok Masuk
                                        @elseif ($stock->change_amount < 0)
                                            Stok Berkurang
                                        @endif
                                    </td>
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
