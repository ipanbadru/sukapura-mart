<?php

namespace App\Http\Livewire\Kasir;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;

    public function render()
    {
        $kasir = User::where('nama', 'like', '%' . $this->search . '%')
                ->orWhere('username', 'like', '%' . $this->search . '%')
                ->role('kasir')->latest()->paginate(10);;
        return view('livewire.kasir.index', compact('kasir'));
    }
}
