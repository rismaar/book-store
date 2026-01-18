<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class supplierController extends Controller
{
    public function create()
    {
        $siup = Supplier::boot();
        return view('addSupplier', compact('siup'));
    }

    public function viewSup()
    {
        $supplier = Supplier::all();
        return view('dataSupplier', compact('supplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string',
            'alamat' => 'required',
            'telp_pt' => 'required|max:13',
            'no_rek' => 'required',
            'bank' => 'required',
            'email' => 'required|email',
            'narahubung' => 'required',
            'no_telp' => 'required|max:13',
            'status' => 'required',
        ]);
        Supplier::create($request->all());
        return redirect()->route('view.supp')->with('success', 'Data successfully added');
    }

    public function update(Request $request, $siup)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string',
            'alamat' => 'required',
            'telp_pt' => 'required|max:13',
            'no_rek' => 'required',
            'bank' => 'required',
            'email' => 'required|email',
            'narahubung' => 'required',
            'no_telp' => 'required',
            'status' => 'required',
        ]);
        $supplier = Supplier::where('siup', $siup)->firstOrFail();
        $supplier->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat' => $request->alamat,
            'telp_pt' => $request->telp_pt,
            'no_rek' => $request->no_rek,
            'bank' => $request->bank,
            'email' => $request->email,
            'narahubung' => $request->narahubung,
            'no_telp' => $request->no_telp,
            'status' => $request->status
        ]);
        return redirect()->route('view.supp')->with('success', 'Data successfully updated!');
    }
}
