<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
    protected $bulans;
    public function __construct()
    {
        $this->bulans = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    }
    public function index()
    {
        $pelanggan = Pelanggan::orderBy('id', 'desc')->get();
        $barang = Barang::all();
        return view('transaksi.index', compact('pelanggan', 'barang'));
    }
    private function replacing($string) 
    {
        return preg_replace('/\D/', '', $string);
    }
    public function transaksi_cash(Request $request)
    {
        $request->validate([
            'barangs' => 'required',
            'totalBayar' => 'required',
            'totalKembali' => 'required',
            'totalHarga' => 'required'
        ]);

        $transaksi = Transaksi::create([
            'id_kasir' => Auth::user()->id,
            'jumlah_bayar' => $request->totalBayar,
            'total_harga' => $request->totalHarga,
            'kembalian' => $request->totalKembali,
        ]);

        foreach($request->barangs as $barang)
        {
            $jumlahBarangOld = Barang::find($barang['id'])['jumlah_barang'];
            Barang::find($barang['id'])->update(['jumlah_barang' => $jumlahBarangOld - $barang['jumlah']]);
            TransaksiDetail::insert([
                'id_transaksi' => $transaksi->id,
                'id_barang' => $barang['id'],
                'total_barang' => $barang['jumlah'],
                'harga_barang' => $this->replacing($barang['harga']),
            ]);
        }
        return response()->json('berhasil');
    }

    public function transaksi_credit(Request $request)
    {
        $request->validate([
            'barangs' => 'required',
            'totalBayar' => 'required',
            'totalKembali' => 'required',
            'sisaTagihan' => 'required',
            'idPelanggan' => 'required',
        ]);

        $tagihan = Tagihan::create([
            'id_kasir' => Auth::user()->id,
            'id_pelanggan' => $request->idPelanggan,
            'total_harga' => $this->replacing($request->totalHarga),
            'total_tagihan' => $this->replacing($request->sisaTagihan)
        ]);

        foreach($request->barangs as $barang)
        {
            $jumlahBarangOld = Barang::find($barang['id'])['jumlah_barang'];
            Barang::find($barang['id'])->update(['jumlah_barang' => $jumlahBarangOld - $barang['jumlah']]);
            TagihanDetail::create([
                'id_tagihan' => $tagihan->id,
                'id_barang' => $barang['id'],
                'total_barang' => $barang['jumlah'],
                'harga_barang' => $this->replacing($barang['harga']),
            ]);
        }
        return response()->json('berhasil');
    }
}
