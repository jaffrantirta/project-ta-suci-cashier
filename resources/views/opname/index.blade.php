@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <a href="{{ route('opname.create') }}" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Tambah</a>
            <div class="card">
                <div class="card-header">Stok Opname</div>

                <div class="card-body">
                    <form action="{{ route('opname.index') }}" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="search" required id="searchInput" class="form-control" placeholder="Search by name..." name="filter[item.name]">
                            <button type="submit" class="btn btn-outline-secondary">Search</button>

                        </div>
                    </form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Satuan</th>
                                <th>Fisik</th>
                                <th>Selisih</th>
                                <th>Dilakukan pada</th>
                                <th>Diinput pada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($opnames as $key => $opname)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $opname->item->sku }}</td>
                                    <td>{{ $opname->item->name }}</td>
                                    <td>{{ $opname->item->unit_of_stock }}</td>
                                    <td>{{ $opname->real_stock }}</td>
                                    <td>{{ $opname->diff_stock }}</td>
                                    <td>{{ $opname->doing_at }}</td>
                                    <td>{{ $opname->created_at }}</td>
                                    <td>{{ $opname->comment }}</td>

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
