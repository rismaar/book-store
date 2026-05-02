<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\User;


class bukuController extends Controller
{
    public function viewProducts()
    {
        $books = Buku::with('kategori')->get();
        $kategori = Kategori::all();
        $supplier = Supplier::all();
        $book = Buku::with('supplier')->get();
        return view('dataProduk', compact('books', 'kategori', 'supplier', 'book'));
    }
    
    public function store(Request $request) 
    {
            $validator = Validator::make($request->all(), [
                'isbn'         => 'required|unique:buku,isbn',
                'title'        => 'required',
                'author'       => 'required',
                'supplier_id'  => 'required|exists:supplier,siup',
                'publish_date' => 'required|date',
                'price'        => 'required|numeric',
                'pages'        => 'required|integer',
                'categories'   => 'required|exists:kategori,id_kategori',   
                'stock'        => 'required|integer',
                'description'  => 'nullable|string',
                'image'        => 'required|image|mimes:jpg,jpeg,png|max:2048', 
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }
            $image = $request->file('image');
            $imgName = Str::uuid() . '.' .$image->getClientOriginalExtension();
            $image->storeAs('cover', $imgName, 'public');

            $data = $request->except('image');
            $data['image'] = $imgName;
            Buku::create($data);

            return redirect()->route('products')->with('success', 'Book added successfully!');

    }

    public function create()
    {
        $categories = Kategori::all();
        $supplier = Supplier::all();
        $book = Buku::with('supplier')->get();
        return view('addProduct', compact('categories', 'supplier', 'book'));
    }

    public function viewUpdate(string $isbn) : View
    {
        $books = Buku::findOrFail($isbn);
        $categories = Kategori::all();
        $supplier = Supplier::all();
        $book = Buku::with('supplier')->get();
        return view('updateProduct', compact('books', 'categories', 'supplier', 'book'));
    }

    public function update(Request $request, string $isbn) : RedirectResponse
    {
        $request->validate([
            'isbn'          => 'required|unique:buku,isbn,' . $isbn . ',isbn',
            'author'        => 'required',
            'title'         => 'required',
            'supplier_id'   => 'required|exists:supplier,siup',
            'publish_date'  => 'required|date',
            'price'         => 'required|numeric',
            'pages'         => 'required|integer',
            'categories'    => 'required|exists:kategori,id_kategori',
            'description'   => 'nullable|string',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $books = Buku::findOrFail($isbn);
        $books->title = $request->title;
        $books->supplier_id = $request->supplier_id;
        $books->isbn = $request->isbn;
        $books->author = $request->author;
        $books->publish_date = $request->publish_date;
        $books->price = $request->price;
        $books->pages = $request->pages;
        $books->categories = $request->categories;
        $books->description = $request->description;

        if($request->hasFile('image')){
            if($books->image){
                Storage::delete($books->image);
            }
            $books->image = $request->file('image')->store('buku');
        }
        $books->save();
        return redirect()->route('products')->with('success', 'data successfully updated');
    }

    public function destroy(string $isbn)
    {
        $book = Buku::findOrFail($isbn);
        $book->delete();
        return redirect()->route('products')->with('success', 'Data successfully deleted');
    }

    public function animate()
    {
        $books = Buku::where('categories', '=', '1', 'and')->get();
        return view('animateFiction', compact('books'));
    }

    public function sejarah()
    {
        $books = Buku::where('categories', '=', '2', 'and')->get();
        return view('history', compact('books'));
    }

    public function mistery()
    {
        $books = Buku::where('categories', '=', '3', 'and')->get();
        return view('mistery', compact('books'));
    }

    public function fiksi()
    {
        $books = Buku::where('categories', '=', '4', 'and')->get();
        return view('fiksiFantasi', compact('books'));
    }

    public function novels()
    {
        $books = Buku::where('categories', '=', '5', 'and')->get();
        return view('novel', compact('books'));
    }

    public function viewFiksi()
    {
        return view('fiksiFantasi');
    }

    public function history()
    {
        return view('history');
    }

    public function misteri()
    {
        return view('mistery');
    }

    public function novel()
    {
        return view('novel');
    }
}
