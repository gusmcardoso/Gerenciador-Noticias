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
    Schema::create('category_noticia', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->foreignId('noticia_id')->constrained()->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_noticia');
    }
};
