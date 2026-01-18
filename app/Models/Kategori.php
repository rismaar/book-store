<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['id_kategori', 'nama_kategori'];
    public $timestamps = false;

    public function books()
    {
        return $this->hasMany(Buku::class);
    }
}
