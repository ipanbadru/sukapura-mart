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
            padding: 0
        }
        table {
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
    </style>
</head>
<body>
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
</body>
</html>