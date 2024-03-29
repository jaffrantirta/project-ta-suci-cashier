@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Transaksi</div>

                <div class="card-body">
                    <!-- Form to add new item to cart -->
                    <form action="{{ route('transaction.index') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <!-- Item name -->
                                <div class="form-group">
                                    <label for="item_name">Item Name</label>
                                    <input type="text" class="form-control" id="item_name" name="item_name" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <!-- Price -->
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <!-- Quantity -->
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" required>
                                </div>
                            </div>
                        </div>
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
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <!-- Add more headers if needed -->
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Loop through cart items and display -->
                                <tr>
                                    <td>Item Name</td>
                                    <td>$10</td>
                                    <td>2</td>
                                    <td>$20</td>
                                    <!-- Add more columns for other details if needed -->
                                </tr>
                                <!-- Repeat this row for each item in the cart -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Grand total price -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h5>Grand Total: $100</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
