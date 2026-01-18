<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Kategori;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku';
    protected $primaryKey = 'isbn';
    public $incrementing = false;
    protected $fillable = ['isbn','title','author','publish_date','price', 'pages', 'categories','stock', 'description', 'image', 'supplier_id'];
    public $timestamps = false;
    protected $guarded = ['selling_price'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'categories','id_kategori')->withDefault(['nama_kategori' => 'no category']);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'nama_produk', 'isbn');
    }

    public function RestockDetails()
    {
        return $this->hasMany(RestockDetail::class, 'isbn', 'isbn');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'siup');
    }

    public static  function booted()
    {
        static::creating(function($book){
            if($book->selling_price === null){
                $book->selling_price = $book->price + 20000;
            }
        });
        static::updating(function($book){
            if($book->isDirty('price')){
                $book->selling_price = $book->price + 20000;
            }
        });
    }
}
