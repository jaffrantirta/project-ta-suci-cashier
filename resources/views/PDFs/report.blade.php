<!DOCTYPE html>
<html>
<head>
    <title>Laporan {{$type === 'stock' ? 'Stok Masuk' : 'Penjualan'}}</title>
</head>
<body>
    <footer>
        <p>
            Nama Toko<br>
            Jalan Denpasar Raya No. 1<br>
            Phone : +62 81712512 ; Email : hola@email.com<br>
        </p>
    </footer>
    <table class="fw">
    <tr>
        {{-- <td class="hw">
            <img alt="logo-KV" src="{{ asset('assets/image/kv_logo.jpeg') }}" width="250"/>
        </td> --}}
        <td class="hw">
            <h2>Laporan {{$type === 'stock' ? 'Stok Masuk' : 'Penjualan'}}</h2>
        </td>
    </tr>
    </table>
    <div>
        <table>
            <tr>
                <td><b>Laporan dibuat tanggal</b></td>
                <td><b>: {{\Carbon\Carbon::now()->format('d M Y')}}</b></td>
            </tr>
            <tr>
                <td><b>Laporan yang ditampilkan dari tanggal</b></td>
                <td><b>: {{\Carbon\Carbon::parse($from_date)->format('d M Y')}}</b></td>
            </tr>
            <tr>
                <td><b>Laporan yang ditampilkan sampai tanggal</b></td>
                <td><b>: {{\Carbon\Carbon::parse($to_date)->format('d M Y')}}</b></td>
            </tr>
        </table>
    </div>
    @if ($type == 'stock')
    <div class="centered-div">
        <table class="full-table bordered-table">
            <tr>
                <th class="bordered-table-header">No.</th>
                <th class="bordered-table-header">Tanggal</th>
                <th class="bordered-table-header">Nama Barang</th>
                <th class="bordered-table-header">Stok Masuk</th>
                <th class="bordered-table-header">Stok Akhir</th>
            </tr>
            @foreach ($data as $key => $d)
                <tr>
                    <td class="bordered-table-content">{{$key+1}}</td>
                    <td class="bordered-table-content">{{\Carbon\Carbon::parse($d->created_at)->format('d M Y H:m:i')}}</td>
                    <td class="bordered-table-content">{{$d->item->name}}</td>
                    <td class="bordered-table-content">{{number_format($d->change_amount)}}</td>
                    <td class="bordered-table-content">{{number_format($d->amount)}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    @else
    <div class="centered-div">
        <table class="full-table bordered-table">
            <tr>
                <th class="bordered-table-header">No.</th>
                <th class="bordered-table-header">Tanggal</th>
                <th class="bordered-table-header">Nomor Nota</th>
                <th class="bordered-table-header">Total barang</th>
                <th class="bordered-table-header">Total biaya</th>
                <th class="bordered-table-header">Jenis Pembayaran</th>
            </tr>
            @foreach ($data as $key => $d)
                <tr>
                    <td class="bordered-table-content">{{$key+1}}</td>
                    <td class="bordered-table-content">{{\Carbon\Carbon::parse($d->created_at)->format('d M Y H:m:i')}}</td>
                    <td class="bordered-table-content">{{$d->number}}</td>
                    <td class="bordered-table-content">{{number_format($d->total_of_item)}}</td>
                    <td class="bordered-table-content">Rp{{number_format($d->total_of_amount)}}</td>
                    <td class="bordered-table-content">{{$d->payment_method}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    @endif


</body>
</html>

<style>
    .page_break {
        page-break-before: always;
    }

    footer {
        position: fixed;
        bottom: -50px;
        width: 100%;
        text-align: center;
    }
    html{
        font-size: 90%;
    }

    .fw{
        width:100%;
    }

    .hw{
        width:50%;
    }

    .centered-text{
        text-align: center;
    }

    .centered-div {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .full-table{
        width: 100%;
    }

    .bordered-table{
        border: 4px solid black;
        border-collapse: collapse;
    }

    .bordered-table-content {
        border: 2px solid black;
        width: auto;
        padding: 7px;
    }

    .bordered-table-header {
        border: 2px solid black;
        font-size: 1.2em;
        width: auto;
    }

    div {
        margin-top: 0.2em;
    }

    .text-align-right{
        text-align: right;
    }

    .text-align-center{
        text-align: center;
    }
/*
    html{
        margin-left: 15%;
        margin-right: 15%;
    } */
</style>
