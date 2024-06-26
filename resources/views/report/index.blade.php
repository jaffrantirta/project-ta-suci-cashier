@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif
            <div class="card">
                <div class="card-header">Laporan</div>

                <div class="card-body">
                    <form action="{{ route('report.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="from_date">Dari Tanggal:</label>
                                    <input type="date" class="form-control @error('from_date') is-invalid @enderror" id="from_date" name="from_date" autocomplete="off" required />
                                    @error('from_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="to_date">Sampai Tanggal:</label>
                                    <input type="date" class="form-control @error('to_date') is-invalid @enderror" id="to_date" name="to_date" autocomplete="off" required />
                                    @error('to_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="type">Jenis Laporan:</label>
                            <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                                @role('owner|cashier')
                                <option value="">Pilih jenis laporan</option>
                                <option value="sales">Laporan Penjualan</option>
                                @endrole
                                @role('owner|operation')
                                <option value="stock">Laporan Stok Masuk</option>
                                <option value="stockout">Laporan Stok Keluar</option>
                                <option value="opname">Laporan Stok Opname</option>
                                @endrole
                            </select>
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="payment_method">Jenis Pembayaran:</label>
                            <select class="form-control @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method">
                                <option value="">Pilih jenis pembayaran</option>
                                <option value="2">Transfer</option>
                                <option value="1">Cash</option>
                            </select>
                            <p class="text-muted">kosongkan jika menampilkan semua metode pembayaran</p>
                            @error('payment_method')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mt-2 col-md-12">
                            <button type="submit" class="btn btn-primary col-md-12">Generate</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
