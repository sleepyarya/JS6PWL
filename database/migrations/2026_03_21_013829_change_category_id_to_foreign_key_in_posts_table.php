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
    Schema::table('posts', function (Blueprint $table) {
        // Karena kolomnya belum ada, kita pakai foreignId() langsung untuk membuat & merelasikan
        $table->foreignId('category_id')
              ->after('id') // Biar letak kolomnya rapi setelah kolom ID
              ->nullable() // Pakai nullable dulu biar post yang sudah ada nggak error
              ->constrained('categories')
              ->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('posts', function (Blueprint $table) {
        // Cara hapus foreign key dan kolomnya
        $table->dropForeign(['category_id']);
        $table->dropColumn('category_id');
    });
}
};
