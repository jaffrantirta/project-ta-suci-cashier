@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <a href="{{ route('itemunit.create') }}" class="btn btn-primary mb-2">Tambah</a>
            <div class="card">
                <div class="card-header">Satuan</div>

                <div class="card-body">
                    <form action="{{ route('itemunit.index') }}" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="search" id="searchInput" class="form-control" placeholder="Search by name..." name="filter[name]">
                            <button type="submit" class="btn btn-outline-secondary">Search</button>
                        </div>
                    </form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama barang</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($itemunits as $key => $itemunit)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $itemunit->name }}</td>
                                    <td>
                                            <a href="{{ route('itemunit.show', ['itemunit' => $itemunit->id]) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                            <a href="#" onclick="event.preventDefault();
                                            if(confirm('Apakah anda yakin ingin menghapus {{ $itemunit->name }}?')) {
                                            document.getElementById('delete-form-{{ $itemunit->id }}').submit(); }" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            <form id="delete-form-{{ $itemunit->id }}" action="{{ route('itemunit.destroy', ['itemunit' => $itemunit->id]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                            </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $itemunits->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
</script>
@endsection
