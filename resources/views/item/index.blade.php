@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <a href="{{ route('item.create') }}" class="btn btn-primary mb-2">Tambah</a>
            <div class="card">
                <div class="card-header">Barang</div>
                
                <div class="card-body">
                    <form action="{{ route('item.index') }}" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="search" id="searchInput" class="form-control" placeholder="Search by name..." name="filter[name]">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>SKU</th>
                                <th>Nama barang</th>
                                <th>Harga</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->sku }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>Rp{{ number_format($item->price) }}</td>
                                    <td>
                                        <a href="{{ route('item.show', ['item' => $item->id]) }}" class="btn btn-primary">Detail</a>
                                        <a href="{{ route('item.edit', ['item' => $item->id]) }}" class="btn btn-primary">Edit</a>
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
