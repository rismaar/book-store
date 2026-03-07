<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Restock;
use App\Models\RestockDetail;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class restockController extends Controller
{
    public function menu()
    {
        $restockCount = Restock::where('status', 'confirmed')->count();
        $receivedCount = Restock::where('status', 'approved')->count();
        $historyCount = Restock::where('status', 'accepted')->orWhere('status', 'rejected')->count();
        return view('menu', compact('restockCount', 'receivedCount',  'historyCount'));
    }

    public function formReq()
    {
        $suppliers = Supplier::where('status', 'Active')->get();
        $books = Buku::all();
        return view('addRequest', compact('suppliers', 'books'));
    }

    public function viewApproved()
    {
        $restock = Restock::where('status', 'approved')->get();
        return view('received', compact('restock'));
    }

    public function viewRest()
    {
        $restock = Restock::where('status', 'confirmed')->get();
        return view('request', compact('restock'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:supplier,siup',
            'produk' => 'required|array|min:1',
            'produk.*' => 'required|exists:buku,isbn',
            'qty' => 'required|array',
            'qty.*' => 'required|integer|min:1',
            'harga' => 'required|array',
            'harga.*' => 'required|numeric|min:0',
        ]);
        DB::beginTransaction();
        try{
            $restock = Restock::create([
                'restock_date' => now(),
                'id_supplier' => $request->supplier_id,
                'status' => 'confirmed',
                'total' => 0,
            ]);
            $total = 0;
            foreach($request->produk as $i => $isbn){
                $qty = $request->qty[$i];
                $harga = $request->harga[$i];
                $subtotal = $qty * $harga;
                $total += $subtotal;

                RestockDetail::create([
                    'id_restock' => $restock->id_restock,
                    'id_produk' => $isbn,
                    'qty' => $qty,
                    'harga' => $harga,
                    'subtotal' => $subtotal
                ]);
            }
            $restock->update([
                'total' => $total
            ]);
            DB::commit();
            return redirect()->route('viewRest')->with('success', 'Request succesfully added!');
        } catch(\Throwable $e){
            DB::rollBack();
            throw $e;
        }
    }

    public function accepted(Restock $restock)
    {
        if($restock->status !== 'approved'){
            return back()->with('error', 'Restock sudah di Proses');
        }
        DB::beginTransaction();
        try{
            $restock->update([
                'status' => 'accepted'
            ]);
            foreach($restock->details as $detail){
                Buku::where('isbn', $detail->id_produk)->increment('stock', $detail->qty);
            }
            DB::commit();
            return response()->json(['status' => 'accepted']);
        } catch(\Throwable $e){
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function invoiceReq($id)
    {
        $restock = Restock::with([
            'supplier',
            'details.book'
        ])->where('id_restock', $id)->firstOrFail();
        $watermark = '';
        $dateInfo  = '';

        if ($restock->status === 'accepted') {
            $watermark = '<div class="paid-watermark">PAID</div>';
            $acceptedAt = $restock->accepted_at
                ? $restock->accepted_at->translatedFormat('d F Y')
                : 'N/A';

            $dateInfo = '<p>Accepted At: '.$acceptedAt.'</p>';

        } elseif ($restock->status === 'rejected') {
            $watermark = '<div class="paid-watermark" style="color: rgba(255,0,0,0.15);">REJECTED</div>';
            $rejectedAt = $restock->rejected_at
                ? $restock->rejected_at->translatedFormat('d F Y')
                : 'N/A';

            $dateInfo = '<p>Rejected At: '.$rejectedAt.'</p>';
        }
        $html = '
            <style>
                body { 
                    font-family: monospace;
                    font-size: 12px; 
                    margin: 20px; 
                }

                .paid-watermark {
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%) rotate(-45deg);
                    font-size: 120px;
                    font-family: Arial, sans-serif;
                    font-weight: bold;
                    color: rgba(0, 128, 0, 0.15);
                    z-index: 0;
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }

                th, td {
                    border: 1px solid #000;
                    padding: 6px;
                }

                th {
                    background-color: #e0e0e0;
                    text-align: left;
                }

                .text-right {
                    text-align: right;
                }
                .line {
                    width: 100%;
                    height: 5px;
                    background: #000;
                    margin: 15px 0;
                }
            </style>

            <div class="info" >
                '.$watermark.'
            
                <h1>Salemba</h1>
                <h3>Request Invoice</h3>

                <p>
                    Date: '.\Carbon\Carbon::parse($restock->restock_date)->translatedFormat('d F Y').'<br>
                    To: '.$restock->supplier->nama_perusahaan.'<br>
                    Email Address: <i>'.$restock->supplier->email.'</i><br>
                    Address: <i>'.$restock->supplier->alamat.'</i>
                </p>

                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                ';
                foreach ($restock->details as $detail) {
                    $html .= '
                        <tr>
                            <td>'.$detail->book->title.'</td>
                            <td class="text-right">'.$detail->qty.'</td>
                            <td class="text-right">IDR '.number_format($detail->harga).'</td>
                            <td class="text-right">IDR '.number_format($detail->subtotal, 2).'</td>
                        </tr>
                    ';
                }
                $html .= '
                    </tbody>
                </table>

                <h3 style="text-align:right; margin-top:20px;">
                    Total: IDR '.number_format($restock->total, 2).'
                </h3><br>
                '.$dateInfo.'
                <div class="line"></div>

                <p>
                    Email us at: <i>call@griyabaca.com</i><br>
                    Address: <i>Jl. Raya Pajajaran No. 88, Bogor</i>
                </p>
                ';
            $html .= '
            </div>';

            

            $pdf = Pdf::loadHTML($html)->setPaper('A4', 'landscape');
            return $pdf->stream("Invoice_Restock_{$restock->id_restock}.pdf");

    }

    public function updateStatus(Request $request, Restock $restock)
    {
        $request->validate([
            'status' => 'required|in:confirmed,approved,rejected,accepted',
        ]);
        if($request->status === 'accepted'){
            if($restock->status !== 'approved'){
                return response()->json(['error' => 'Restock must be approved before accepting.'], 400);
            }
            DB::transaction(function() use ($restock) {
                $restock->update([
                    'status' => 'accepted', 'accepted_at' => now()]);
                foreach($restock->details as $detail){
                    Buku::where('isbn', $detail->id_produk)->increment('stock', $detail->qty);
                }
            });
            return response()->json(['status' => 'accepted', 'accepted_at' => $restock->accepted_at->format('d-m-Y H:i')]);
        }

        if($request->status === 'rejected'){
            if($restock->status === 'accepted'){
                return response()->json(['error' => 'Restock has been accepted.'], 400);
            }
            DB::transaction(function() use ($restock) {
                $restock->update([
                    'status' => 'rejected', 'rejected_at' => now()]);
            });
            return response()->json(['status' => 'rejected', 'rejected_at' => $restock->rejected_at->format('d-m-Y H:i')]);
        }

        if($request->status === 'approved'){
            if($restock->status !== 'confirmed'){
                return response()->json(['error' => 'Only confirmed restocks can be approved.'], 400);
            }
            DB::transaction(function() use($restock){
                $restock->update([
                    'status' => 'approved', 'approved_at' => now()]);
            });
            return response()->json(['status' => 'approved', 'approved_at' => $restock->approved_at->format('d-m-Y H:i')]);
        }
        $restock->update(['status' => $request->status]);
        return response()->json(['status' => $request->status]);
    }

    public function recent()
    {
        $restock = Restock::where('status', 'accepted')->orWhere('status', 'rejected')->get();
        $acceptedCount = Restock::where('status', 'accepted')->count();
        $rejectedCount = Restock::where('status', 'rejected')->count();
        return view('recentRestock', compact('restock', 'acceptedCount', 'rejectedCount'));
    }

    public function sendGmail($id)
    {
        $restock = Restock::with('supplier')->findOrFail($id);
        $to = $restock->supplier->email;
        $date = \Carbon\Carbon::parse($restock->restock_date)->translatedFormat('d F Y');
        $subject = 'Request Restock Notification';
        $body = 
            "Dear. {$restock->supplier->nama_perusahaan}, \n\n" .
            "Below we send a restock request invoice with details: \n\n" .
            "Restock ID: {$restock->id_restock}\n" .
            "Restock Date: {$date}\n" .
            "Total Amount: IDR " . number_format($restock->total, 2) . "\n\n" .
            "Please find the attached invoice for your reference.\n\n" .
            "Best regards,\n" .
            "Salemba Team";
        $gmailurl = "https://mail.google.com/mail/?view=cm&fs=1" . "&to=" . urlencode($to) . "&su=" . urlencode($subject) . "&body=" . urlencode($body);
        return redirect()->away($gmailurl);
    }
}
