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
        Schema::create('server', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('lokasi_server');
            $table->string('ip_router')->nullable();
            $table->string('port_api')->nullable();
            $table->string('alamat');
            $table->string('jatuh_tempo');
            $table->enum('pajak',['Aktif','Tidak aktif']);
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('status');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server');
    }
};
