@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ isset($stock) ? 'Detail "' . $stock->name .'"' : 'Tambah stock' }}</div>
                <div class="card-body">
                    <form action="{{ isset($stock) ? route('stock.update', ['stock' => $stock->id]) : route('stock.store') }}" method="POST">
                        @csrf
                        @if(isset($stock))
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="name">Barang</label>
                            <select name="item_id" class="form-control @error('name') is-invalid @enderror">
                                <option value="">- pilih barang -</option>
                                @foreach ($items as $key => $item )
                                    <option value={{$item->id}}>{{$item->name}}
                                @endforeach
                            </select>
                            @error('item_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="change_amount">Jumlah</label>
                            <input type="text" class="form-control @error('change_amount') is-invalid @enderror" id="change_amount" name="change_amount" value="{{ isset($stock) ? old('change_amount') ?? $stock->change_amount : '' }}" required>
                            @error('change_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input name="amount" value="0" class="d-none"/>
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
