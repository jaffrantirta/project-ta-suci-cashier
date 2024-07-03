@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex flex-wrap justify-content-start mb-3">
                <div class="col-md-6">
                    <button type="button" class="btn btn-primary me-3" onclick="showTransactions('today')">Hari ini</button>
                    <button type="button" class="btn btn-primary" onclick="showTransactions('yesterday')">Kemarin</button>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <input type="date" id="dateFilterInput" class="form-control" placeholder="Filter Tanggal" onchange="filterDate()">
                        <button class="btn btn-outline-secondary" type="button" onclick="filterDate()">Filter</button>
                    </div>
                </div>
            </div>

            <div id="transactions" class="card">
                <div class="card-header" id="transactions-header">Transaksi Hari Ini</div>
                <div class="card-body">
                    <h4 class="card-title">
                        <strong id="transactions-count">{{ $transactionsToday }}</strong>
                    </h4>
                </div>
            </div>

            <script>
                function updateTransactionsHeaderAndCount(date, count) {
                    document.getElementById('transactions-header').innerText = `Transaksi pada ${date}`;
                    document.getElementById('transactions-count').innerText = count;
                }

                function showTransactions(type) {
                    let date = new Date();
                    if (type === 'today') {
                        date = new Date();
                    } else if (type === 'yesterday') {
                        date.setDate(date.getDate() - 1);
                    }

                    let formattedDate = date.toISOString().split('T')[0];
                    fetchTransactions(formattedDate);
                }

                function filterDate() {
                    let selectedDate = document.getElementById('dateFilterInput').value;
                    if (selectedDate) {
                        fetchTransactions(selectedDate);
                    }
                }

                function fetchTransactions(date) {
                    fetch('{{ route("fetch-transactions-by-date") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ date: date })
                    })
                    .then(response => response.json())
                    .then(data => {
                        updateTransactionsHeaderAndCount(data.date, data.transactionsCount);
                    })
                    .catch(error => console.error('Error fetching transactions:', error));
                }
            </script>

            @if ($runningLowStock && count($runningLowStock) > 0)
            <div class="card mt-3">
                <div class="card-header">Barang menipis</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($runningLowStock as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ abs($item->stock?->amount) }} {{ $item->item_unit->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <div class="card mt-3">
                <div class="card-header">Barang terlaris</div>
                <div class="card-body">
                    <canvas id="bestSellerChart" width="400" height="200"></canvas>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">Penjualan Bulanan Tahun Ini</div>
                <div class="card-body">
                    <canvas id="monthlySalesChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Best seller chart
        var bestSellerNames = @json($bestSellerNames);
        var bestSellerQuantities = @json($bestSellerQuantities).map(Math.abs);

        var bestSellerCtx = document.getElementById('bestSellerChart').getContext('2d');
        var bestSellerChart = new Chart(bestSellerCtx, {
            type: 'bar',
            data: {
                labels: bestSellerNames,
                datasets: [{
                    label: 'Quantity Sold',
                    data: bestSellerQuantities,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return Math.abs(tooltipItem.raw) + ' units';
                            }
                        }
                    }
                }
            }
        });

        // Monthly sales chart
        var monthlySalesData = @json($monthlySalesData);

        var monthlySalesCtx = document.getElementById('monthlySalesChart').getContext('2d');
        var monthlySalesChart = new Chart(monthlySalesCtx, {
            type: 'line',
            data: {
                datasets: [{
                    label: 'Monthly Sales',
                    data: monthlySalesData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    });
</script>
@endsection
