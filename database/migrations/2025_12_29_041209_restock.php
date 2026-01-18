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
        Schema::create('restock', function(Blueprint $table){
            $table->string('id_restock')->primary();
            $table->date('restock_date');
            $table->string('id_supplier');
            $table->foreign('id_supplier')->references('siup')->on('supplier')->cascadeOnDelete();
            $table->string('status')->default('confirmed');
            $table->decimal('total', 15, 2)->default(0);
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
