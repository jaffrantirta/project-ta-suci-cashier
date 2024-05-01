@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
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
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" step="0.01" value="{{ isset($user) ? old('password') ?? $user->password : '' }}" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="cashier" {{ isset($user) && $user->role == 'cashier' ? 'selected' : '' }}>Kasir</option>
                                <option value="operation" {{ isset($user) && $user->role == 'operation' ? 'selected' : '' }}>Operasi Gudang</option>
                            </select>
                            @error('role')
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
