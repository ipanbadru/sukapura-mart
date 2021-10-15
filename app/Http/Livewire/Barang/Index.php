<?php

namespace App\Http\Livewire\Barang;

use App\Models\Barang;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    public $search;
    public function render()
    {
        $barang = Barang::where('nama_barang', 'like', '%' . $this->search . '%')
                        ->latest()->paginate(10);
        return view('livewire.barang.index', compact('barang'));
    }

    public function hapusBarang($id)
    {
        $barang = Barang::find($id);
        $barang->delete();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Berhasil',
            'text' => 'Barang Berhasil di hapus'
        ]);
    }
}
