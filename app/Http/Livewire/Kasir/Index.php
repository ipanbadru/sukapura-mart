<?php

namespace App\Http\Livewire\Kasir;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rules;

class Index extends Component
{
    use WithPagination;
    // Property Untuk Menambah / Mengubah data kasir
    public $id_kasir, $nama, $username, $email, $password, $password_confirmation;

    public $search;

    protected function rules() 
    {
        $kasir = null;
        if($this->id_kasir){
            $kasir = User::find($this->id_kasir);
            $passwordRule = ['sometimes', 'confirmed', Rules\Password::defaults()];
        }else{
            $passwordRule = ['required', 'confirmed', Rules\Password::defaults()];
        }
        return [
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:25', 'alphanum', Rule::unique('users')->ignore($kasir)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($kasir)],
            'password' => $passwordRule
        ];
    }
    public function render()
    {
        $kasir = User::where('nama', 'like', '%' . $this->search . '%')
                ->orWhere('username', 'like', '%' . $this->search . '%')
                ->role('kasir')->latest()->paginate(10);
        return view('livewire.kasir.index', compact('kasir'));
    }

    public function resetValidate()
    {
        $this->resetValidation();
    }

    public function submited($id_kasir, $nama, $username, $email, $password, $password_confirmation)
    {
        $this->id_kasir = $id_kasir;
        $this->nama = $nama;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password ?? null;
        $this->password_confirmation = $password_confirmation ?? null;
        // Validasi Input
        $data = $this->validate();

        if($this->id_kasir){
            // Update Data
            $kasir = User::find($this->id_kasir);
            $kasir->update($data);
        }else{
            // Menambah Data
            $user = User::create($data);
            $user->assignRole('kasir');
        }

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Berhasil',
            'text' => $this->id_kasir ? 'Kasir Berhasil di update' : 'Kasir Berhasil di tambahkan',
        ]);
        return 'berhasil';
    }

    public function hapusKasir($id)
    {
        $kasir = User::find($id);
        $kasir->delete();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Berhasil',
            'text' => 'Kasir Berhasil di hapus'
        ]);
    }
}
