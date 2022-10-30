<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_atribut', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->references('id')->on('produk')->onDelete('cascade');
            $table->integer('stok');
            $table->integer('produk_rejected');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk_atribut');
    }
};
