<?php

namespace App\Http\Controllers;

use App\Exports\TagihanExport;
use Maatwebsite\Excel\Facades\Excel;

class TagihanController extends Controller
{
    public function index()
    {
        return view('tagihan.index');
    }

    public function exporttagihan()
    {
        return Excel::download(new TagihanExport, 'Tagihan.xlsx');
    }
}
