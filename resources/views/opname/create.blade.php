@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ isset($opname) ? 'Detail "' . $opname->name .'"' : 'Add opname' }}</div>
                <div class="card-body">
                    <form action="{{ isset($opname) ? route('opname.update', ['opname' => $opname->id]) : route('opname.store') }}" method="POST">
                        @csrf
                        @if(isset($opname))
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="sku">Kode Barang/SKU</label>
                            <input type="text" class="form-control @error('sku') is-invalid @enderror" id="sku" name="sku" value="{{ isset($opname) ? old('sku') ?? $opname->sku : '' }}" required>
                            @error('sku')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="real_stock">Fisik</label>
                            <input type="number" class="form-control @error('real_stock') is-invalid @enderror" id="real_stock" name="real_stock" value="{{ isset($opname) ? old('real_stock') ?? $opname->real_stock : '' }}" required>
                            @error('real_stock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="diff_stock">Selisih</label>
                            <input type="number" class="form-control @error('diff_stock') is-invalid @enderror" id="diff_stock" name="diff_stock" step="0.01" value="{{ isset($opname) ? old('diff_stock') ?? $opname->diff_stock : '' }}" required>
                            @error('diff_stock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="doing_at">Tangga opname dilakukan</label>
                            <input type="date" class="form-control @error('doing_at') is-invalid @enderror" id="doing_at" name="doing_at" step="0.01" value="{{ isset($opname) ? old('doing_at') ?? $opname->doing_at : '' }}" required>
                            @error('doing_at')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="comment">Keterangan</label>
                            <input type="text" class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" step="0.01" value="{{ isset($opname) ? old('comment') ?? $opname->comment : '' }}" required>
                            @error('comment')
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
