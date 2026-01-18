<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'supplier';
    protected $primaryKey = 'siup';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['siup','nama_perusahaan', 'alamat', 'telp_pt', 'no_rek', 'bank', 'email', 'narahubung', 
        'no_telp','status'];

    public function restocks()
    {
        return  $this->hasMany(Restock::class, 'id_supplier', 'siup');
    }

    protected static function boot(){
        parent::boot();
        static::creating(function($model){
            if(!empty($model->siup)){
                return;
            }
            $lastId = DB::table('supplier')->max('siup');
            $number = $lastId ? (int) substr($lastId, 3) + 1: 1;
            $model->siup = 'SPP' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }

    public function buku()
    {
        return $this->hasMany(Buku::class, 'supplier_id', 'siup');
    }
}   
