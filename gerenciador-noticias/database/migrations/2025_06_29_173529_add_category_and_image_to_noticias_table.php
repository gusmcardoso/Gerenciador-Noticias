<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::table('noticias', function (Blueprint $table) {
        $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
        $table->string('image')->nullable();
    });
}

public function down(): void
{
    Schema::table('noticias', function (Blueprint $table) {
        $table->dropForeign(['category_id']);
        $table->dropColumn(['category_id', 'image']);
    });
}
};
