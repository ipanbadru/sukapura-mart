<?php 

 function getTitleNameLaporan($request)
{
    $bulans = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    function format_date($date){
        return date('d-m-Y', strtotime($date));
    }
    $title = '';
    if($request['data'] === 'harian'){
        $title = "Data Transaksi Tanggal " . format_date($request['tgl']) ;
    }else if($request['data'] === 'mingguan'){
        $title = "Data Transaksi Per Minggu " . format_date($request['tgl_mulai']) . " - " . format_date($request['tgl_akhir']);
    }else if($request['data'] === 'bulanan'){
        $title = "Data Transaksi Bulan " . $bulans[$request['bulan']] . " Tahun " . $request['tahun'];
    }else {
        $title = "Data Transaksi";
    }
    return $title;
}
 ?>