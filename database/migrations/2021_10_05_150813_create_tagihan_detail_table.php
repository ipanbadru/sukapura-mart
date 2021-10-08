<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagihanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagihan_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tagihan');
            $table->foreignId('id_barang');
            $table->bigInteger('total_barang');
            $table->bigInteger('harga_barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tagihan_detail');
    }
}
