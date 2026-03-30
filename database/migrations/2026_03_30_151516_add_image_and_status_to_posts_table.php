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
        $table->string('image')->nullable()->after('content'); // Kolom buat simpan nama file foto
        $table->boolean('is_published')->default(false)->after('image'); // Kolom status (on/off)
    });
}

public function down(): void
{
    Schema::table('posts', function (Blueprint $table) {
        $table->dropColumn(['image', 'is_published']);
    });
}
};
