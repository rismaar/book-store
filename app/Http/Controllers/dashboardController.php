<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function home(Request $request)
    {
        $kategoriData = DB::table('buku')->join('kategori', 'buku.categories', '=', 'kategori.id_kategori')
                        ->select('kategori.nama_kategori as kategori', DB::raw('COUNT(buku.isbn) as total'))->groupBy('kategori.nama_kategori')->get();
        $recentTransaction = Transaksi::latest()->take(4)->get();
        $start = $request->start_date;
        $end = $request->end_date;
        $totalProduk = Buku::count();
        $query = Transaksi::with('details.buku');

        if($start && $end){
            $query->whereBetween('tanggal', [$start, $end]);
        }
        $transaksi = $query->get();
        return view('dashboard', compact('transaksi', 'start', 'end', 'totalProduk', 'recentTransaction', 'kategoriData'));
    }

    public function search(Request $request)
    {
        $keyword = trim(strtolower($request->q));
        if(!$keyword){
            return redirect()->back();
        }
        $books = Buku::where(function($q) use($keyword){
            $q->whereRaw('LOWER(title) LIKE ?', ["%{$keyword}%"])->orWhere('isbn', 'like', '%{$keyword}%');
        })->get();
        return view('searchResults', compact('books', 'keyword'));
    }
}
