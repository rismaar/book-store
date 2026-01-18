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
        Schema::create('restock_detail', function(Blueprint $table){
            $table->id();
            $table->string('id_restock');
            $table->string('id_produk');

            $table->foreign('id_restock')->references('id_restock')->on('restock')->cascadeOnDelete();
            $table->foreign('id_produk')->references('isbn')->on('buku')->cascadeOnDelete();

            $table->integer('qty');
            $table->decimal('harga', 15, 2);
            $table->decimal('subtotal', 15, 2);
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
