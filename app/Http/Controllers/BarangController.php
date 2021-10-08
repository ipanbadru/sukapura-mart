<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\Barang;
use App\Exports\BarangExport;
use App\Exports\BarangTemplate;
use App\Http\Requests\BarangRequest;
use App\Imports\BarangImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $barang = Barang::latest()->where('nama_barang', 'like', '%' . $request->search . '%')->paginate(10);
        return view('barang.index', compact('barang'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.create', ['barang' => new Barang, 'button' => 'Tambah']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BarangRequest $request)
    {
       Barang::create($request->all());
       return redirect('barang')->with('success', 'Barang Berhasil di tambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        return view('barang.edit', ['barang' => $barang, 'button' => 'Edit']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(BarangRequest $request, Barang $barang)
    {
        $barang->update($request->all());
        return redirect('barang')->with('success', 'Barang berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        session()->flash('success', 'Data berhasil di hapus');
        Barang::find($id)->delete();
        return json_encode('berhasil');
    }

    public function generate_barcode()
    {
        function generate()
        {
            $id = Barang::latest()->first()['id'];
            $now = Carbon::now();
            $kode = '';
            for($i = 0; $i < 4; $i++)
            {
                $kode .= rand(0, 9);
            }
            $kode .= sprintf("%02s", $now->minute) . sprintf("%02s", $now->second) . sprintf("%03s", $id);
            if(Barang::where('kode_barang')->first())
            {
                return generate();
            }else{
                return $kode;
            }
        }
        return generate();
    }

    public function cetak_barcode(Request $request)
    {
        $barang = Barang::where('kode_barang', $request->kode_barang)->first();
        $jumlah_perulangan = $request->jumlah / 4;
        $sisa_bagi = $request->jumlah % 4;
        $dompdf = new Dompdf();
        $html = view('barang.cetak_barcode', compact('barang', 'jumlah_perulangan', 'sisa_bagi'));
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream('Barcode.pdf', ['Attachment' => true]);
    }

    // Excel
    public function exportbarang()
    {
        return Excel::download(new BarangExport, 'Data Barang.xlsx');
    }

    public function importbarang(Request $request)
    {
        $request->validate([
            'file' => ['required', 'mimes:xlsx']
        ]);

        // Mengatur Penamaan nama file pada saat Import
        $directory = getcwd() . '/BarangData/';
        $filecount = 0;
        $files2 = glob( $directory ."*" );
        if( $files2 ) {
            $filecount = count($files2);
        }
        $filecount += 1;

        $file = $request->file('file');
        $namaFile = "($filecount)" . $file->getClientOriginalName();
        $file->move('BarangData', $namaFile);

        // Import
        Excel::import(new BarangImport, public_path('/BarangData/' . $namaFile));
        return redirect()->back()->with('success', 'Import Barang berhasil di lakukan');
    }

    public function templatebarang()
    {
        return Excel::download(new BarangTemplate, 'Template Data Barang.xlsx');
    }
}
