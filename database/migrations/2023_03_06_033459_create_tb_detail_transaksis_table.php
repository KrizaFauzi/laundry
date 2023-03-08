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
        Schema::create('tb_detail_transaksi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_transaksi')->unsigned()->nullable();
            $table->foreign('id_transaksi')->references('id')->on('tb_transaksi')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('id_paket')->unsigned()->nullable();
            $table->foreign('id_paket')->references('id')->on('tb_pakets')->onDelete('cascade')->onUpdate('cascade');
            $table->double('qty', 8, 2)->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('tb_detail_transaksi');
    }
};
