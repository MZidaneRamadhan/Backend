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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('nomor_layanan')->unique();
            $table->string('name');
            $table->string('telp');
            $table->string('email');
            $table->string('status_tagihan');
            $table->foreignId('server_id')->constrained('server')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('cluster_id')->constrained('cluster')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('paket_internet_id')->constrained('paket_internet')->onUpdate('cascade')->onDelete('cascade');
            $table->string('login')->nullable();
            $table->string('sales')->nullable();
            $table->string('no_ktp')->nullable();
            $table->date('tgl_pemasangan');
            $table->string('tgl_jatuh_tempo');
            $table->string('biaya_pemasangan')->nullable();
            $table->string('foto')->nullable();
            $table->string('koordinat')->nullable();
            $table->string('metode_langganan');
            $table->integer('biaya_tambahan_id')->nullable();
            $table->integer('diskon_id')->nullable();
            $table->string('alamat');
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('desa')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
