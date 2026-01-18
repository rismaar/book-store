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
        Schema::create('buku', function (Blueprint $table){
            $table->string('isbn')->primary();
            $table->string('title');
            $table->date('publish_date');
            $table->string('author');
            $table->integer('stock');
            $table->integer('pages');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->integer('categories');
            $table->string('image')->default('default.jpg');
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
