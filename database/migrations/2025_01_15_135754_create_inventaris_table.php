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
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('nm_barang');
            $table->string('harga_pembelian');
            $table->date('tgl_pembelian');
            $table->integer('pelanggan_id')->nullable();
            $table->integer('server_id');
            $table->string('alamat_ip')->nullable();
            $table->string('alamat_mac')->nullable();
            $table->string('status');
            $table->string('ket')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};
