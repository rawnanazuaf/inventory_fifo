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
        Schema::create('ledger', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_transaksi');
            $table->string('penambahan')->nullable();
            $table->integer('unit_penambahan')->nullable();
            $table->integer('harga_satuan_penambahan')->nullable();
            $table->integer('total_harga_penambahan')->nullable();
            $table->string('pengurangan')->nullable();
            $table->integer('unit_pengurangan')->nullable();
            $table->integer('harga_satuan_pengurangan')->nullable();
            $table->integer('total_harga_pengurangan')->nullable();
            $table->string('persediaan')->nullable();
            $table->integer('unit_persediaan')->nullable();
            $table->integer('harga_satuan_persediaan')->nullable();
            $table->integer('total_harga_persediaan')->nullable();
            $table->enum('is_active',[1,0])->default(1)->nullable();
            $table->foreign('id_transaksi')->references('id')->on('transaksi');
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
        Schema::dropIfExists('ledger');
    }
};
