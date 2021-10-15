<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        table {
            margin-top: 100px;
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #ececec;
        }

        table,
        th,
        td {
            padding: 6px;
            text-align: center;
            border: 1px solid black;
        }
        h1{
            text-align: center;
            font-size: 2rem
        }
        h3{
            text-align: center
        }
        img{
            position: absolute;
            top: 15px;
            left: 15px;
            width: 90px;
        }
        .title-content{
            width: 100%;
            padding: 10px 100px;
            margin: auto;
            position: relative;
            border-bottom: 2px solid black;
        }  
        p{
            text-align: center
        }
        .table-content{
            padding-top: 40px;
        }
    </style>
</head>
<body>
    <div class="title-content">
        <img src="img/logo.png" alt="Logo App">
        <h1>{{ config('app.name') }} Laporan</h1>
        <h3>{{ $title == 'Data Transaksi' ? 'Semua Data Laporan Transaksi' : $title}}</h3>
        <p>{{ $alamat }}</p>
    </div>
    <div class="table-content">
        <table>
            <tr>
                <th>No</th>
                <th>Id Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Nama Barang</th>
                <th>Jumlah Barang</th>
                <th>Total</th>
            </tr>
            <?php $no = 1; ?>
            @foreach ($transaksi as $trans)
                @foreach ($trans->detail as $detail)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $trans->id }}</td>
                    <td>{{ date('d-m-Y', strtotime($trans->created_at)) }}</td>
                    <td>{{ $detail->barang->nama_barang }}</td>
                    <td>{{ $detail->total_barang }}</td>
                    <td>Rp. {{ number_format($detail->harga_barang, 0, '.', '.') }}</td>
                </tr>
                @endforeach
            @endforeach
        </table>
    </div>
</body>
</html>