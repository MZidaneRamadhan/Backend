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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('alamat');
            $table->string('telp');
            $table->enum('login',['Izinkan','Tolak']);
            $table->date('tgl_lahir')->nullable();
            $table->date('tgl_bergabung');
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('jenis_kelamin',['Perempuan','Laki-laki'])->nullable();
            $table->string('kualifikasi_tertinggi')->nullable();
            $table->enum('role',['super_admin','admin','finance','karyawan']);
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
