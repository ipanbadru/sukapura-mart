<?php

namespace App\Http\Controllers;

use App\Exports\PelangganTemplate;
use App\Http\Requests\PelangganRequest;
use App\Imports\PelangganImport;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pelanggan = Pelanggan::where('nama_pelanggan', 'like', '%' . $request->search . '%')
                                ->orWhere('nik', 'like', '%' . $request->search . '%')
                                ->orderBy('id', 'desc')->paginate(10);
        return view('pelanggan.index', compact('pelanggan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PelangganRequest $request)
    {
        $save = Pelanggan::create($request->all());
        return response()->json($save);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(PelangganRequest $request, Pelanggan $pelanggan)
    {
        $pelanggan->update($request->all());
        return response()->json($pelanggan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelanggan $pelanggan)
    {
        session()->flash('success', 'Data berhasil di hapus');
        $pelanggan->delete();
        return json_encode('berhasil');
    }

    // Download Template Excel data pelanggan
    public function templatepelanggan()
    {
        return Excel::download(new PelangganTemplate, 'Template Data Pelanggan.xlsx');
    }

    // Import Data Pelanggan dari excel
    public function importpelanggan(Request $request)
    {
        $request->validate([
            'file' => ['required', 'mimes:xlsx']
        ]); 


        // Mengatur Penamaan nama file pada saat Import
        $directory = getcwd() . '/PelangganData/';
        $filecount = 0;
        $files2 = glob( $directory ."*" );
        if( $files2 ) {
            $filecount = count($files2);
        }
        $filecount += 1;

        $file = $request->file('file');
        $namaFile = "($filecount)" . $file->getClientOriginalName();
        $file->move('PelangganData', $namaFile);

        // Import
        Excel::import(new PelangganImport, public_path('/PelangganData/' . $namaFile));
        return redirect()->back()->with('success', 'Import Barang berhasil di lakukan');
    }
}
