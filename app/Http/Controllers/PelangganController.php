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
    public function index()
    {
        return view('pelanggan.index');
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
