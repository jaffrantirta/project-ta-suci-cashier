@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-11">

            <div class="card">
                <div class="card-header">{{ isset($user) ? 'Detail "' . $user->name .'"' : 'Add user' }}</div>
                <div class="card-body">
                    <form action="{{ isset($user) ? route('user.update', ['user' => $user->id]) : route('user.store') }}" method="POST">
                        @csrf
                        @if(isset($user))
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ isset($user) ? old('name') ?? $user->name : '' }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ isset($user) ? old('email') ?? $user->email : '' }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="price">Harga</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" step="0.01" value="{{ isset($user) ? old('price') ?? $user->price : '' }}" required>
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
