@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ isset($stock) ? 'Detail "' . $stock->name .'"' : 'Add stock' }}</div>
                <div class="card-body">
                    <form action="{{ isset($stock) ? route('stock.update', ['stock' => $stock->id]) : route('stock.store') }}" method="POST">
                        @csrf
                        @if(isset($stock))
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="name">Nama barang</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ isset($stock) ? old('name') ?? $stock->name : '' }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sku">SKU</label>
                            <input type="text" class="form-control @error('sku') is-invalid @enderror" id="sku" name="sku" value="{{ isset($stock) ? old('sku') ?? $stock->sku : '' }}" required>
                            @error('sku')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Harga</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" step="0.01" value="{{ isset($stock) ? old('price') ?? $stock->price : '' }}" required>
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
