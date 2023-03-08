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
        Schema::create('tb_transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_outlet')->constrained('tb_outlets')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignId('id_member')->constrained('tb_members')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->string('kode_inv', 100)->nullable();
            $table->date('tanggal')->nullable();
            $table->date('batas_waktu')->nullable();
            $table->date('tanggal_bayar')->nullable();
            $table->integer('biaya_tambahan')->nullable();
            $table->double('diskon', 4, 2)->nullable();
            $table->integer('pajak')->nullable();
            $table->double('total_harga', 10, 2)->nullable();
            $table->enum('status', ['baru', 'proses', 'selesai', 'diambil'])->nullable();
            $table->enum('dibayar', ['dibayar', 'belum_dibayar'])->nullable();
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
        Schema::dropIfExists('tb_transaksi');
    }
};
