<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('loans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('member_id');
            $table->uuid('loaned_by_user_id');
            $table->timestampTz('loaned_at'); // Instante del préstamo

            // FK-4 y FK-5: RESTRICT
            $table->foreign('member_id')->references('id')->on('members')->onDelete('restrict');
            $table->foreign('loaned_by_user_id')->references('id')->on('users')->onDelete('restrict');
        });
    }
    public function down(): void { Schema::dropIfExists('loans'); }
};