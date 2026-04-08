<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Restock extends Model
{
    protected $table = 'restock';
    protected $primaryKey = 'id_restock';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $casts = ['accepted_at' => 'datetime', 'rejected_at' => 'datetime', 'approved_at' => 'datetime'];

    protected $fillable = [
        'restock_date',
        'id_supplier',
        'status',
        'accepted_at',
        'rejected_at',
        'approved_at',
        'total'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            DB::transaction(function () use ($model) {
                $count = DB::table('restock')->lockForUpdate()->count();
                if ($count === 0) {
                    $number = 1;
                } else {
                    $lastId = DB::table('restock')
                        ->lockForUpdate()
                        ->orderBy('id_restock', 'desc')
                        ->value('id_restock');

                    $number = (int) substr($lastId, -3) + 1;
                }

                $model->id_restock = 'RSC' . str_pad($number, 3, '0', STR_PAD_LEFT);
            });
        });
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier', 'siup');
    }

    public function details()
    {
        return $this->hasMany(RestockDetail::class, 'id_restock', 'id_restock');
    }

    public function getKeyName()
    {
        return 'id_restock';
    }

    public function scopeFilterByYear($query, $year)
    {
        if($year){
            return $query->whereYear('restock_date', $year);
        }
        return $query;
    }
}
