<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi_detail', function (Blueprint $table) {
        $table->id();

        $table->string('id_transaksi');
        $table->string('nama_produk'); 
        $table->integer('price');
        $table->integer('jumlah');
        $table->integer('total');
        $table->foreign('id_transaksi')
            ->references('id_transaksi')
            ->on('transaksi')
            ->onDelete('cascade');
        $table->foreign('nama_produk')
            ->references('isbn')
            ->on('buku');
        $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
