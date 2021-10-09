<?php

namespace App\Http\Livewire\Tagihan;

use App\Models\Pelanggan;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search;
    public function render()
    {
        $pelanggan = Pelanggan::orderBy('id', 'desc')->getTagihan()
                    ->where('nama_pelanggan', 'like', '%' . $this->search . '%')
                    ->paginate(10);
        return view('livewire.tagihan.index', compact('pelanggan'));
    }

    public function getPelanggan($id)
    {
        $pelanggan = Pelanggan::find($id);
        $pelanggan->total_tagihan = $pelanggan->jumlah_tagihan;
        $this->emit('getPelanggan', $pelanggan);
    }
}
