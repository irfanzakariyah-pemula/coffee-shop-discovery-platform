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
        Schema::create('coffee_shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('address');
            $table->string('city', 100);
            $table->string('area', 100)->nullable();
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('phone', 20)->nullable();
            $table->string('email')->nullable();
            $table->integer('price_min')->default(0);
            $table->integer('price_max')->default(0);
            $table->decimal('rating_avg', 3, 2)->default(0.00);
            $table->integer('rating_count')->default(0);
            $table->integer('view_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Indexes for performance
            $table->index('slug');
            $table->index('city');
            $table->index('area');
            $table->index(['latitude', 'longitude']);
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coffee_shops');
    }
};
