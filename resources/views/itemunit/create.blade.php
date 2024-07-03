@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ isset($itemunit) ? 'Detail "' . $itemunit->name .'"' : 'Add Item' }}</div>
                <div class="card-body">
                    <form action="{{ isset($itemunit) ? route('itemunit.update', ['itemunit' => $itemunit->id]) : route('itemunit.store') }}" method="POST">
                        @csrf
                        @if(isset($itemunit))
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="name">Nama satuan</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ isset($itemunit) ? old('name') ?? $itemunit->name : '' }}" required>
                            @error('name')
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
