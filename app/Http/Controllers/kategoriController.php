<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class kategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('dataKategori', compact('kategori'));
    }

    public function addKategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ]);
        Kategori::create($request->all());
        return redirect()->route('index.kat')->with('success', 'Data successfullt added!');
    }
}
