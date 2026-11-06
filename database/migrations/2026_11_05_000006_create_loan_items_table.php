<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('loan_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('loan_id');
            $table->uuid('book_id');
            $table->string('book_title', 250); // Congelado
            $table->char('isbn', 13);          // Congelado
            $table->string('category_name', 120); // Congelado sin FK
            $table->timestampTz('due_at');
            $table->timestampTz('returned_at')->nullable();

            // FK-2: CASCADE. FK-3: RESTRICT
            $table->foreign('loan_id')->references('id')->on('loans')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('restrict');
            
            // Único préstamo por libro (Sección 4)
            $table->unique(['loan_id', 'book_id']);
        });
    }
    public function down(): void { Schema::dropIfExists('loan_items'); }
};