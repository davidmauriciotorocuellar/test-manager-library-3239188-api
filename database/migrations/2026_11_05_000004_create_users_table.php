<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('username', 120)->unique();
            $table->string('password_hash', 512); // NUNCA indexar (Sección 7)
            $table->string('role', 40);
        });
    }
    public function down(): void { Schema::dropIfExists('users'); }
};