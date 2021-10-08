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
    public function index(Request $request)
    {
        $title = $this->getTitleName($request);
        $bulans = $this->bulans;
        $transaksi = Transaksi::latest()->filterLaporan(request(['data', 'tgl', 'tgl_mulai', 'tgl_akhir', 'bulan', 'tahun']))
                                ->where('id', 'like', '%' . $request->search . '%')
                                ->paginate(10)->withQueryString();
        $lastYear = date('Y', strtotime(Transaksi::latest()->first()->created_at));
        return view('laporan.index', compact('transaksi', 'lastYear', 'bulans', 'title'));
    }

    public function detail(Transaksi $transaksi)
    {
        return view('laporan.detail', compact('transaksi'));
    }

    public function exportexcel(Request $request)
    {
        $title = $this->getTitleName($request);
        $transaksi = Transaksi::filterLaporan(request(['data', 'tgl', 'tgl_mulai', 'tgl_akhir', 'bulan', 'tahun']))->get();
        return Excel::download(new LaporanExport($transaksi), $title . '.xlsx');
    }

    public function exportpdf(Request $request)
    {
        $title = $this->getTitleName($request);
        $transaksi = Transaksi::filterLaporan(request(['data', 'tgl', 'tgl_mulai', 'tgl_akhir', 'bulan', 'tahun']))->get();
        $dompdf = new Dompdf();
        $html = view('laporan.exportpdf', compact('title', 'transaksi'));
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream($title . '.pdf', ['Attachment' => true]);
    }

    private function getTitleName($request)
    {
        function format_date($date){
            return date('d-m-Y', strtotime($date));
        }
        $title = '';
        if($request->data === 'harian'){
            $title = "Data Transaksi Tanggal " . format_date($request->tgl) ;
        }else if($request->data === 'mingguan'){
            $title = "Data Transaksi Satu Minggu " . format_date($request->tgl_mulai) . " - " . format_date($request->tgl_akhir);
        }else if($request->data === 'bulanan'){
            $title = "Data Transaksi Bulan " . $this->bulans[$request->bulan] . " Tahun $request->tahun";
        }else {
            $title = "Data Transaksi";
        }
        return $title;
    }
}
