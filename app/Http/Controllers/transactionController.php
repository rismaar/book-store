<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class transactionController extends Controller
{
    public function addTrans()
    {
        $Transaksi = Transaksi::boot();
        return view('addTransaction', compact('Transaksi'));
    }

    public function viewTrans(Request $request)
    {
        $books = Buku::all();
        $start = $request->start_date;
        $end = $request->end_date;
        $query = Transaksi::with('details.buku');
        if($start && $end){
            $query->whereBetween('tanggal', [$start, $end]);
        }
        $transaksi = $query->get();
        return view('transaction', compact('books', 'transaksi', 'end', 'start'));
    }

    public function storeTrans(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'metode_pembayaran' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.nama_produk' => 'required|exists:buku,isbn',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {

            $transaksi = Transaksi::create([
                'tanggal' => $request->tanggal,
                'metode_pembayaran' => $request->metode_pembayaran,
                'grand_total' => 0,
            ]);

            $grandTotal = 0;

            foreach ($request->items as $item) {

                $buku = Buku::lockForUpdate()
                    ->where('isbn', $item['nama_produk'])
                    ->first();

                if ($buku->stock < $item['jumlah']) {
                    abort(400, "Stok {$buku->title} tidak mencukupi");
                }

                $total = $item['jumlah'] * $buku->selling_price;
                TransaksiDetail::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'nama_produk' => $buku->isbn,
                    'jumlah' => $item['jumlah'],
                    'price' => $buku->selling_price,
                ]);
                $buku->decrement('stock', $item['jumlah']);
                $grandTotal += $total;
            }
            $transaksi->update([
                'grand_total' => $grandTotal
            ]);
        });
        return redirect()->route('viewTrans')->with('success', 'Transaction successfully');
    }

    public function invoice($id)
    {
        $transaksi = Transaksi::with('details.buku')->findOrFail($id);
        $itemCount = $transaksi->details->count();
        $totalHeight = 300;
        foreach($transaksi->details as $d){
            $title = $d->buku->title ?? '';
            $charsPerLine = 28;
            $lines = ceil(strlen($title) / $charsPerLine);
            $rowHeight = 20 + ($lines * 10);
            $totalHeight += $rowHeight;
        }
        $paperHeight = $totalHeight;
        $html = '
        <style>
            body {
                font-family: monospace;
                font-size: 10px;
                margin: 0;
                padding: 5px;
            }
            .center { text-align: center; }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            td {
                padding: 2px 0;
            }
            .line {
                border-top: 1px dashed #000;
                margin: 5px 0;
            }
            .left {
                text-align: left;
            }
        </style>

        <div class="center">
            <b>Salemba Book</b><br>
            Kota Bogor, Jawa Barat<br>
            Telp +21 234 0901
        </div>

        <div class="line"></div>

        <p>
            ID: '.$transaksi->id_transaksi.'<br>
            Date: '. \Carbon\Carbon::parse($transaksi->tanggal)->translatedFormat('d F Y') .'<br>
            Payment Method: '.$transaksi->metode_pembayaran.'
        </p>

        <div class="line"></div>

        <table>';
        
        foreach ($transaksi->details as $d) {
            $html .= '
            <tr>
                <td colspan="2">'.$d->buku->title.'</td>
            </tr>
            <tr>
                <td>'.$d->jumlah.' x '.number_format($d->price,2).'</td>
                <td align="right">IDR. '.number_format($d->total,2).'</td>
            </tr>';
        }
        $html .= '
        </table>

        <div class="line"></div>
        <table>
            <tr>
                <td><b>TOTAL</b></td>
                <td align="right"><b>IDR. '.number_format($transaksi->grand_total,2).'</b></td>
            </tr>
        </table>
        <div class="line"></div>
        <div class="center">
            Thank You!
        </div>
        <div class="left">
            <b>NOTES: </b><br>
            Items that have already been purchased cannot be returned or exchanged.<br>
            Please keep this receipt as proof of purchase.
        </div>
        ';

        $pdf = Pdf::loadHTML($html)->setPaper([0, 0, 226.77, $paperHeight], 'portrait'); 
        return $pdf->stream('struk_'.$transaksi->id_transaksi.'.pdf');
    }

    public function report(Request $request) 
    {
        $start = $request->start_date;
        $end = $request->end_date;
        $transact = Transaksi::with('details.buku')->whereBetween('created_at', [$start.' 00:00:00', $end.' 23:59:59'])->get();
        $total = $transact->sum('grand_total');
        return view('report', compact('start', 'end', 'transact', 'total'));
    }
}