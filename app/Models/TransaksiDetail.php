<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;
use App\Models\Transaksi;

class TransaksiDetail extends Model
{
    protected $table = 'transaksi_detail';
    protected $fillable = ['id_transaksi', 'nama_produk', 'jumlah', 'price', 'total'];
    public $timestamps = true;
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'nama_produk', 'isbn');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function($detail){
            $detail->total = $detail->jumlah * $detail->price;
        });
    }
}
