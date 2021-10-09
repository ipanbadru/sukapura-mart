<?php

namespace App\Http\Livewire\Tagihan;

use Livewire\Component;

class Bayar extends Component
{
    public $total_tagihan;
    public $sisa_tagihan;
    public $nama_pelanggan;
    public $id_pelanggan;
    public $total_bayar;
    public $openModal = false;

    protected $listeners = [
        'getPelanggan' => 'showTagihanPelanggan'
    ];

    public function render()
    {
        return view('livewire.tagihan.bayar');
    }

    public function showTagihanPelanggan($pelanggan)
    {
        $this->openModal = true;
        $this->nama_pelanggan = $pelanggan['nama_pelanggan'];
        $this->id_pelanggan = $pelanggan['id'];
        $this->total_tagihan = $pelanggan['total_tagihan'];
    }
}
