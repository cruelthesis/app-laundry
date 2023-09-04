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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id('idtransaksi');
            $table->integer('idoutlet');
            $table->integer('idmember');
            $table->date('tanggal')->nullable();
            $table->double('diskon')->nullable();
            $table->enum('status',['baru','proses','selesai','diambil'])->nullable();
            $table->enum('pembayaran',['sudahdibayar','belumdibayar'])->nullable();
            $table->integer('iduser');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};