<?php

namespace App\Http\Livewire\Pelanggan;

use App\Models\Pelanggan;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    // Property untuk menambah atau mengubah pelanggan
    public $id_pelanggan, $nik, $nama_pelanggan, $no_hp;

    public $search;
    protected function rules()
    {
        $pelanggan = null;
        if($this->id_pelanggan){
            $pelanggan = Pelanggan::find($this->id_pelanggan);
        }
        return [
            'nik' => ['required', 'numeric', Rule::unique('pelanggan')->ignore($pelanggan)],
            'nama_pelanggan' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'numeric', Rule::unique('pelanggan')->ignore($pelanggan)]
        ];
    }
    public function render()
    {
        $pelanggan = Pelanggan::where('nama_pelanggan', 'like', '%' . $this->search . '%')
                            ->orWhere('nik', 'like', '%' . $this->search . '%')
                            ->orderBy('id', 'desc')->paginate(10);
        return view('livewire.pelanggan.index', compact('pelanggan'));
    }

    public function resetValidate()
    {
        $this->resetValidation();
    }
    
    public function submited($id_pelanggan, $nik, $nama_pelanggan, $no_hp)
    {
        $this->id_pelanggan = $id_pelanggan;
        $this->nik = $nik;
        $this->nama_pelanggan = $nama_pelanggan;
        $this->no_hp = $no_hp;

        $data = $this->validate();

        if($this->id_pelanggan){
            $pelanggan = Pelanggan::find($this->id_pelanggan);
            $pelanggan->update($data);
        }else{
            Pelanggan::create($data);
        }

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Berhasil',
            'text' => $this->id_pelanggan ? 'Data Pelanggan Berhasil di Update' : 'Data Berhasil di tambahkan',
        ]);
        return 'berhasil';
    }

    public function hapusPelanggan($id)
    {
        $pelanggan = Pelanggan::find($id);
        $pelanggan->delete();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Berhasil',
            'text' => 'Data Pelanggan berhasil di hapus',
        ]);
    }
}
