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
            $table->id(); // Sama seperti userId AUTO_INCREMENT PRIMARY KEY
            $table->string('username'); // Tambahan dari struktur baru
            $table->string('name'); // Bisa disesuaikan jika redundan dengan 'username'
            $table->string('email')->unique();
            $table->string('alamat'); // Tambahan dari struktur baru
            $table->string('nomorTelepon'); // Tambahan dari struktur baru
            $table->unsignedBigInteger('roleId'); // Tambahan dari struktur baru
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            // Jika ada relasi ke tabel roles, bisa tambahkan foreign key:
            // $table->foreign('roleId')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
