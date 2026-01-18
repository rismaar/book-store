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
        Schema::create('supplier', function(Blueprint $table){
            $table->string('siup')->unique()->primary();
            $table->string('nama_perusahaan');
            $table->text('alamat');
            $table->string('telp_pt');
            $table->string('no_rek');
            $table->string('bank');
            $table->string('email');
            $table->string('narahubung');
            $table->string('no_telp');
            $table->string('status');
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
