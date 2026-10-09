<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class ProductController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();

        return view('index', compact('barangs'));
    }
}
