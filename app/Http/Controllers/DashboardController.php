<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stok = Barang::sum('jumlah_barang');
        $penjualan = Transaksi::count();
        $pendapatan = 'Rp. ' . number_format(TransaksiDetail::sum('harga_barang'), 0, '.', '.');
        $barang_terjual = TransaksiDetail::sum('total_barang');
        return view('dashboard.index', compact('stok', 'penjualan', 'pendapatan', 'barang_terjual'));
    }
}
