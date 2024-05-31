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
                        <div class="form-group mb-2">
                            <label for="number_of_invoice">Nomor Nota</label>
                            <input type="text" class="form-control @error('number_of_invoice') is-invalid @enderror" id="number_of_invoice" name="number_of_invoice" value="{{ isset($stock) ? old('number_of_invoice') ?? $stock->number_of_invoice : '' }}" required>
                            @error('number_of_invoice')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control @error('supplier_name') is-invalid @enderror" name="supplier_name" placeholder="Supplier" aria-label="Supplier" aria-describedby="button-addon2" required>
                            @error('supplier_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="data">Barang - barang</label>
                            <div id="dataContainer" class="d-flex flex-wrap gap-2">
                            <hr class="w-100">
                                <span>No. 1</span>
                                <div class="input-group">
                                    <select name="data[0][item_id]" class="form-control @error('data.*.item_id') is-invalid @enderror" required>
                                        <option value="">- pilih barang -</option>
                                        @foreach ($items as $key => $item )
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('data.*.item_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('data.*.change_amount') is-invalid @enderror" name="data[0][change_amount]" placeholder="Jumlah" aria-label="Jumlah" aria-describedby="button-addon2" required>
                                    @error('data.*.change_amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary mt-2" id="button-addon2">+</button>
                        </div>

                        <hr>

                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const dataContainer = document.getElementById('dataContainer');
    const buttonAddon2 = document.getElementById('button-addon2');
    let index = 1;

    buttonAddon2.addEventListener('click', function() {
        const hr = document.createElement('hr');
        hr.className = 'w-100';


        const span = document.createElement('span');
        span.textContent = 'No. ' + (index + 1);

        const itemId = document.createElement('select');
        const options = [];

        // Use an IIFE to create a new scope for each iteration
        @foreach ($items as $item)
            (function() {
                const option = document.createElement('option');
                option.value = '{{ $item->id }}';
                option.textContent = '{{ $item->name }}';
                options.push(option);
            })();
        @endforeach

        // Append options to the select element
        options.forEach(option => itemId.appendChild(option));

        // Add classes and attributes to the select element
        itemId.classList.add('form-control');
        itemId.name = `data[${index}][item_id]`;
        itemId.required = true;



        const changeAmount = document.createElement('input');
        changeAmount.classList.add('form-control');
        changeAmount.name = `data[${index}][change_amount]`;
        changeAmount.placeholder = 'Jumlah';
        changeAmount.ariaLabel = 'Jumlah';
        changeAmount.ariaDescribedby = 'button-addon2';
        changeAmount.required = true;

        dataContainer.appendChild(hr);
        dataContainer.appendChild(span);
        dataContainer.appendChild(itemId);
        dataContainer.appendChild(changeAmount);

        index++;
    });
</script>

@endsection

