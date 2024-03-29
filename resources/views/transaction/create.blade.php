@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="card">
                <div class="card-header">Tambah Transaksi</div>
                <div class="card-body">
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                <div class="row mb-3">
                    <div class="col-md-12">
                        <!-- Item name -->
                        <div class="form-group">
                            <label for="item_name">Kode Barang (SKU)</label>
                            <input type="text" class="form-control" id="sku" name="sku" required>
                        </div>
                    </div>
                    <div class="col-md-12 mt-1">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                        <button type="button" class="btn btn-secondary">Cek</button>
                    </div>
                </div>
                    </form>
            </div>
            </div>
            <div class="card mt-5">
                <div class="card-header">Transaksi</div>

                <div class="card-body">
                    <!-- Form to add new item to cart -->
                    <form action="{{ route('transaction.store') }}" method="POST">
                        @csrf
                        <!-- Submit button -->
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </div>
                        </div>
                    </form>

                    <!-- Table list cart -->
                    <div class="table-responsive mt-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Barang</th>
                                    <th>harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <!-- Add more headers if needed -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>Rp{{number_format($item->price)}}</td>
                                    <td>{{number_format($item->quantity)}}</td>
                                    <td>Rp{{number_format($item->getPriceSum())}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Grand total price -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h5>Grand Total: Rp{{number_format($sub_total)}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
