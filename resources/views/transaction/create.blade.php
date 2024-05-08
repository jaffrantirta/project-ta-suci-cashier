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
                                    <input autofocus type="text" class="form-control" id="sku" name="sku" required>
                                </div>
                            </div>
                            <div class="col-md-12 mt-1">
                                <button type="submit" class="btn btn-primary">Tambah</button>
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="customer_name">Nama Pelanggan</label>
                                            <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="customer_address">Alamat Pelanggan</label>
                                            <input type="text" class="form-control" id="customer_address" name="customer_address" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


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
                                    <td class="input-group">
                                        <input class="form-control cart-quantity" type="number" value="{{ $item->quantity }}" id="quantity-{{ $item->id }}" />
                                        <button type="button" onclick="updateQuantity({{$item->id}})" class="btn btn-outline-secondary mx-1"><i class="fa fa-check"></i></button>
                                    </td>
                                    <td>Rp{{number_format($item->getPriceSum())}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Grand total price -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h5>Jumlah Total: Rp{{number_format($sub_total)}}</h5>
                            <h5 id="grand_total" style="display: none">{{$sub_total}}</h5>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h5>Metode Pembayaran:</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" onclick="showFormAmountAndChange()" id="payment_method_transfer" value="transfer">
                                <label class="form-check-label" for="payment_method_transfer">
                                    Transfer
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" onclick="showFormAmountAndChange()" id="payment_method_cash" value="cash">
                                <label class="form-check-label" for="payment_method_cash">
                                    Cash
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3" id="show_form_amount_and_change" style="display: none">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pay_amount">Jumlah Uang</label>
                                <input type="number" class="form-control" name="pay_amount" id="pay_amount" onchange="console.log('asas')">
                            </div>
                            <div class="form-group">
                                <label for="change_amount">Kembalian</label>
                                <input type="number" readonly class="form-control" name="change_amount" id="change_amount">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

        const calculateChange = function() {
            const payAmount = document.querySelector('#pay_amount').value;
            const subTotal = document.querySelector('#sub_total').value;
            const changeAmount = payAmount - subTotal;
            console.log(changeAmount);
            document.querySelector('#change_amount').value = changeAmount;
        };

        const showFormAmountAndChange = function() {
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
            if (paymentMethod === 'cash') {
                document.querySelector('#show_form_amount_and_change').style.display = 'block';
            } else {
                document.querySelector('#show_form_amount_and_change').style.display = 'none';
            }
        };

        const updateQuantity = function(id) {
            const quantityInput = document.querySelector(`#quantity-${id}`);
            const quantity = parseInt(quantityInput.value);

            if (quantity < 1) {
                quantityInput.value = 1;
                return;
            }
            const url = '{{ route('cart.update', ['cart' => 'id']) }}'.replace('id', id);

            fetch(url, {
                method: "PUT",
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    quantity: quantity,
                })
            })
            .then(() => window.location.reload())
        };

</script>

@endsection

