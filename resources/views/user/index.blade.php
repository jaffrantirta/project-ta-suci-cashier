@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <a href="{{ route('user.create') }}" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Tambah</a>
            <div class="card">
                <div class="card-header">User</div>

                <div class="card-body">
                    <form action="{{ route('user.index') }}" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="search" required id="searchInput" class="form-control" placeholder="Search by name..." name="filter[name]">
                            <button type="submit" class="btn btn-outline-secondary">Search</button>

                        </div>
                    </form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td><span class="badge text-bg-secondary">{{ $user->roles->first()->name }}</span></td>
                                    <td>
                                        <a href="{{ route('user.show', ['user' => $user->id]) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                        <a href="#" onclick="event.preventDefault();
                                        if(confirm('Apakah anda yakin ingin menghapus {{ $user->name }}?')) {
                                        document.getElementById('delete-form-{{ $user->id }}').submit(); }" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        <form id="delete-form-{{ $user->id }}" action="{{ route('user.destroy', ['user' => $user->id]) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                        </form>
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
