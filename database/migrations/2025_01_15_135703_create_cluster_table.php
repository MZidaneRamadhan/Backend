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
        Schema::create('cluster', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('nm_cluster');
            $table->string('jumlah_port');
            $table->string('jenis');
            $table->integer('server_id');
            $table->string('koordinat')->nullable();
            $table->text('alamat')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cluster');
    }
};
