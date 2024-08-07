@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ isset($item) ? 'Detail "' . $item->name .'"' : 'Add Item' }}</div>
                <div class="card-body">
                    <form action="{{ isset($item) ? route('item.update', ['item' => $item->id]) : route('item.store') }}" method="POST">
                        @csrf
                        @if(isset($item))
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="name">Nama barang</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ isset($item) ? old('name') ?? $item->name : '' }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Harga</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" step="0.01" value="{{ isset($item) ? old('price') ?? $item->price : '' }}" required>
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="item_unit_id">Nama Satuan</label>
                            <select class="form-control @error('item_unit_id') is-invalid @enderror" id="item_unit_id" name="item_unit_id" required>
                                <option value="">- pilih satuan -</option>
                                @foreach($itemunits as $itemunit)
                                    <option value="{{ $itemunit->id }}" {{ isset($item) && $item->item_unit_id == $itemunit->id ? 'selected' : '' }}>{{ $itemunit->name }}</option>
                                @endforeach
                            </select>
                            @error('item_unit_id')
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
