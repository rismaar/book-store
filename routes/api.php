<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SupplierProductController;
use App\Models\Buku;
use Illuminate\Support\Facades\Cache;

Route::get('/supplier/{siup}/products', function ($siup) {
    return Buku::where('supplier_id', $siup)
        ->select('isbn', 'title')
        ->get();
});
