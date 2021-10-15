<?php

namespace App\Http\Livewire\Laporan;

use App\Models\Transaksi;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search, $dataLaporan, $tgl, $tgl_mulai, $tgl_akhir, $bulan, $tahun;

    public $detail_modal, $data_transaksi_detail;

    protected $queryString = ['dataLaporan', 'tgl', 'tgl_mulai', 'tgl_akhir', 'bulan', 'tahun'];
    public function mount()
    {
        $this->dataLaporan = request()->query('dataLaporan', $this->dataLaporan);
        $this->tgl = request()->query('tgl', $this->tgl);
        $this->tgl_mulai = request()->query('tgl_mulai', $this->tgl_mulai);
        $this->tgl_akhir = request()->query('tgl_akhir', $this->tgl_akhir);
        $this->bulan = request()->query('bulan', $this->bulan);
        $this->tahun = request()->query('tahun', $this->tahun);
    }

    public function render()
    {
        $dataFilter = $this->getDataFilter();
        $title = getTitleNameLaporan($dataFilter);
        $bulans = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $transaksi = Transaksi::latest()->filterLaporan($dataFilter)
                                ->where('id', 'like', '%' . $this->search . '%')
                                ->paginate(10)->withQueryString();
        $lastYear = date('Y', strtotime(Transaksi::latest()->first()->created_at));
        return view('livewire.laporan.index', compact('transaksi', 'lastYear', 'bulans', 'title'));
    }

    public function filterData($dataLaporan, $tgl, $tgl_mulai, $tgl_akhir, $bulan, $tahun)
    {
        $this->dataLaporan = $dataLaporan;
        $tgl ? $this->tgl = $tgl : $this->tgl = null;
        $tgl_mulai ? $this->tgl_mulai = $tgl_mulai : $this->tgl_mulai = null;
        $tgl_akhir ? $this->tgl_akhir = $tgl_akhir : $this->tgl_akhir = null;
        $bulan ? $this->bulan = $bulan : $this->bulan = null;
        $tahun ? $this->tahun = $tahun : $this->tahun = null;
    }

    public function resetData()
    {
        $this->dataLaporan = null;
        $this->tgl = null;
        $this->tgl_mulai = null;
        $this->tgl_akhir = null;
        $this->bulan = null;
        $this->tahun = null;
    }

    public function detailTransaksi($id)
    {
        $this->data_transaksi_detail = Transaksi::find($id);
        $this->detail_modal = true;
    }

    private function getDataFilter()
    {
        return [
            'data' => $this->dataLaporan,
            'tgl' => $this->tgl,
            'tgl_mulai' => $this->tgl_mulai,
            'tgl_akhir' => $this->tgl_akhir,
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
        ];
    }
}
