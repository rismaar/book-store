<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestockDetail extends Model
{
    protected $table = 'restock_detail';
    protected $fillable = ['id_restock', 'id_produk', 'qty', 'harga', 'subtotal'];
    public $timestamps = true;
    public function restock()
    {
        return $this->belongsTo(Restock::class);
    }

    public function book()
    {
        return $this->belongsTo(Buku::class, 'id_produk', 'isbn');
    }
}
