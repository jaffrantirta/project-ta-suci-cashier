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
                            <button type="submit" class="btn btn-outline-secondary">Search</button>
                        </div>
                    </form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>SKU</th>
                                <th>Nama barang</th>
                                {{-- <th>Stok</th>
                                <th>Satuan</th> --}}
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
                                    {{-- <td>{{ $item->stock?->amount }}</td>
                                    <td>{{ $item->unit_of_stock }}</td> --}}
                                    <td>Rp{{ number_format($item->price) }}</td>
                                    <td>
                                            <a href="{{ route('item.show', ['item' => $item->id]) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                            <a href="#" onclick="event.preventDefault();
                                            if(confirm('Apakah anda yakin ingin menghapus {{ $item->name }}?')) {
                                            document.getElementById('delete-form-{{ $item->id }}').submit(); }" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            <form id="delete-form-{{ $item->id }}" action="{{ route('item.destroy', ['item' => $item->id]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                            </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $items->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
</script>
@endsection
