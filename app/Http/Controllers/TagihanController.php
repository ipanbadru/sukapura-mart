<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tagihan;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihan = Tagihan::latest()->get();
        return view('tagihan.index', compact('tagihan'));
    }
}
