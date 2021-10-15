<?php

namespace App\Http\Livewire\Tagihan;

use App\Models\Tagihan;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    // Property Untuk bayar tagihan
    public $openModal = false, $total_tagihan, $sisa_tagihan, $nama_pelanggan, $id_tagihan, $total_bayar, $kembalian;

    // Property Untuk detail tagihan
    public $detail_modal, $data_tagihan_detail;

    public $search;

    public function render()
    {
        $tagihan = Tagihan::with('pelanggan')->latest()->getTagihanPelanggan($this->search)->paginate(10);
        return view('livewire.tagihan.index', compact('tagihan'));
    }

    public function bayarTagihan($id)
    {
        $tagihan = Tagihan::find($id);
        $this->openModal = true;
        $this->kembalian = null;
        $this->nama_pelanggan = $tagihan->pelanggan->nama_pelanggan;
        $this->id_tagihan = $tagihan->id;
        $this->total_tagihan = $tagihan->total_tagihan;
        $this->sisa_tagihan = $this->total_tagihan;
    }

    public function setSisaTagihan($total_bayar)
    {
        $this->total_bayar = $total_bayar;
        if($total_bayar == ''){
            $this->sisa_tagihan = $this->total_tagihan;
            $this->kembalian = null;
        }else{
            $sisa_tagihan = preg_replace('/\D/', '', $this->total_tagihan) - preg_replace('/\D/', '', $total_bayar);
            if($sisa_tagihan < 0){
                $this->kembalian = 'Rp. ' . number_format(abs($sisa_tagihan), 0, '.', '.');
            }else {
                $sisa_tagihan = 'Rp. ' . number_format($sisa_tagihan, 0, '.', '.');
                $this->sisa_tagihan = $sisa_tagihan;
                $this->kembalian = null;
            }
        }
    }

    public function bayar()
    {
        $this->validate([
            'total_bayar' => 'required'
        ]);
        if($this->id_tagihan){
            $tagihan = Tagihan::find($this->id_tagihan);
            if($this->kembalian == null && $this->sisa_tagihan != 'Rp. 0'){
                $tagihan->update([
                    'total_tagihan' => $this->sisa_tagihan,
                ]);
            }else{
                // Menjumlahkan total bayar pelanggan
                $jumlah_bayar = $this->kembalian == null ? $tagihan->total_harga : $tagihan->total_harga + preg_replace('/\D/', '', $this->kembalian); 

                $transaksi = Transaksi::create([
                    'id_kasir' => Auth::user()->id,
                    'jumlah_bayar' => $jumlah_bayar,
                    'total_harga' => $tagihan->total_harga,
                    'kembalian' => $this->kembalian ?? 0
                ]);
                
                $tagihan->update([
                    'id_transaksi' => $transaksi->id,
                    'total_tagihan' => 0,
                ]);

                foreach($tagihan->detail as $detail){
                    TransaksiDetail::insert([
                        'id_transaksi' => $transaksi->id,
                        'id_barang' => $detail->id_barang,
                        'total_barang' => $detail->total_barang,
                        'harga_barang' => $detail->harga_barang,
                    ]);
                }
            }
        }

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Berhasil',
            'text' => 'Tagihan Berhasil di bayar',
        ]);

        $this->openModal = false;
    }

    public function detailTagihan($id){
        $this->detail_modal = true;
        $this->data_tagihan_detail = Tagihan::find($id);
    }
}
