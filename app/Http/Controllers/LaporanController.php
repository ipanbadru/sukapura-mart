<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    protected $bulans;
    public function __construct()
    {
        $this->bulans = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    }
    public function index()
    {
        return view('laporan.index');
    }

    public function exportexcel(Request $request)
    {
        $title = getTitleNameLaporan($request);
        $transaksi = Transaksi::filterLaporan(request(['data', 'tgl', 'tgl_mulai', 'tgl_akhir', 'bulan', 'tahun']))->get();
        return Excel::download(new LaporanExport($transaksi), $title . '.xlsx');
    }

    public function exportpdf(Request $request)
    {
        $title = getTitleNameLaporan($request);
        $transaksi = Transaksi::filterLaporan(request(['data', 'tgl', 'tgl_mulai', 'tgl_akhir', 'bulan', 'tahun']))->get();
        $dompdf = new Dompdf();
        $dompdf->getOptions()->setChroot(public_path());
        $html = view('laporan.exportpdf', compact('title', 'transaksi'));
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream($title . '.pdf', ['Attachment' => true]);
    }


}
