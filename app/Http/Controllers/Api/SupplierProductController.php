<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

class supplierProductController extends Controller
{
    public function index($supplier)
    {   
        return Buku::where('supplier_id', $supplier)->select('isbn', 'title')->get();
    }
}
