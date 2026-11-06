<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 250);
            $table->string('author', 200);
            $table->char('isbn', 13);
            $table->uuid('category_id');
            $table->integer('total_copies');
            $table->integer('available_copies');
            $table->string('cover_key', 512)->nullable();
            $table->timestampTz('deleted_at')->nullable();

            // FK-1: RESTRICT según sección 5
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict');
        });

        // Índice parcial único para ISBN activos (Sección 4)
        DB::statement('CREATE UNIQUE INDEX books_isbn_unique_active ON books (isbn) WHERE deleted_at IS NULL');
        
        // Constraint de motor: Última barrera de concurrencia (Sección 4)
        DB::statement('ALTER TABLE books ADD CONSTRAINT ck_book_available_range CHECK (available_copies >= 0 AND available_copies <= total_copies)');
    }
    public function down(): void { Schema::dropIfExists('books'); }
};