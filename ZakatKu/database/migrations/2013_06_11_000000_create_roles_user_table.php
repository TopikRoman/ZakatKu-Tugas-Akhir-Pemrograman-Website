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
        Schema::create('roles_user', function (Blueprint $table) {
            $table->id('roleId'); // PRIMARY KEY, AUTO_INCREMENT
            $table->string('namaRoles'); // NOT NULL
            $table->timestamps(); // Untuk created_at dan updated_at, opsional sesuai kebutuhan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles_user');
    }
};
