@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-start mb-3">
                <button type="button" class="btn btn-primary me-3" onclick="showTransactions('today')">Hari ini</button>
                <button type="button" class="btn btn-primary" onclick="showTransactions('yesterday')">Kemarin</button>
            </div>

            <div id="today-transaction">
                <div class="card">
                    <div class="card-header">Transaksi Hari Ini</div>
                    <div class="card-body">
                        <h4 class="card-title">
                            <strong>{{ $transactionsToday }}</strong>
                        </h4>
                    </div>
                </div>
            </div>

            <div id="yesterday-transaction" style="display: none;">
                <div class="card">
                    <div class="card-header">Transaksi Kemarin</div>
                    <div class="card-body">
                        <h4 class="card-title">
                            <strong>{{ $transactionsYesterday }}</strong>
                        </h4>
                    </div>
                </div>
            </div>

            <script>
                window.onload = function() {
                    document.getElementById('today-transaction').style.display = 'block';
                }

                function showTransactions(type) {
                    document.getElementById('today-transaction').style.display = 'none';
                    document.getElementById('yesterday-transaction').style.display = 'none';

                    document.getElementById(type + '-transaction').style.display = 'block';
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
                                <td>{{ abs($item->stock?->amount) }} {{ $item->unit_of_stock }}</td>
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
                // labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
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
