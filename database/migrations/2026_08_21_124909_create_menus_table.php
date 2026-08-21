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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coffee_shop_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('category', 50)->nullable(); // e.g., Coffee, Food, Dessert
            $table->integer('price'); // in IDR (integer to avoid float issues)
            $table->string('image')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
            
            $table->index('coffee_shop_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
