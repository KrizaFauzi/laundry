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
        Schema::create('tb_pakets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_outlet')->unsigned()->nullable();
            $table->foreign('id_outlet')->references('id')->on('tb_outlets')->onDelete('cascade')->onUpdate('cascade');   
            $table->enum('jenis', ['kiloan', 'selimut','bed_cover', 'kaos', 'lain'])->nullable();
            $table->string('nama_paket' , 100)->nullable(); 
            $table->integer('harga')->nullable();
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
        Schema::dropIfExists('tb_pakets');
    }
};
