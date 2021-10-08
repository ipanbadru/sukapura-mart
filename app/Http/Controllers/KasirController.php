<?php

namespace App\Http\Controllers;

use App\Http\Requests\KasirUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kasir = User::where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('username', 'like', '%' . $request->search . '%')
                    ->role('kasir')->latest()->paginate(10);
        return view('kasir.index', compact('kasir'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(KasirUpdateRequest $request, User $user)
    {
        $user->update($request->all());
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        session()->flash('success', 'Data berhasil di hapus');
        $user->delete();
        return json_encode('berhasil');
    }
}
