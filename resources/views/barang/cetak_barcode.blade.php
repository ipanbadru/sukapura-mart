<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Barcode</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        table {
            border-collapse: collapse;
        }

        td {
            padding: 0.9rem 1.888rem;
            text-align: center;
            letter-spacing: 2px
        }

        img {
            width: 8.5rem;
            height: 2.3rem;
        }

    </style>
</head>

<body>
    <table>
        @for ($i = 0; $i < $jumlah_perulangan; $i++) 
            <tr>
                <?php 
                    if($i + 1 > $jumlah_perulangan){
                        $row = $sisa_bagi;
                    }else{
                        $row = 4;
                    }
                    ?>
                    @for ($j = 0; $j < $row; $j++)
                    <td>
                        {!! $barang->barcode !!}
                        {{ $barang->kode_barang }}
                    </td>
                    @endfor
            </tr>
        @endfor
    </table>
</body>

</html>
