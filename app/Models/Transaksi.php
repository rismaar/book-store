<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    public $incrementing = false;
    protected $fillable = ['tanggal', 'grand_total', 'metode_pembayaran'];
    protected static function boot(){
        parent::boot();
        static::creating(function($model){
            if(!empty($model->id_transaksi)){
                return;
            }
            $lastId = DB::table('transaksi')->max('id_transaksi');
            $number = $lastId ? (int) substr($lastId, 2) + 1: 1;
            $model->id_transaksi = 'AB' . str_pad($number, 3, '0', STR_PAD_LEFT);
        });
    }

    public function details()
    {
        return $this->hasMany(TransaksiDetail::class, 'id_transaksi', 'id_transaksi');
    }

}
