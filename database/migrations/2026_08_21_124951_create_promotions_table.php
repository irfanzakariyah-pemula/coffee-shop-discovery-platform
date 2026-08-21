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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coffee_shop_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('discount_type', ['percentage', 'fixed', 'buy_x_get_y'])->default('percentage');
            $table->integer('discount_value')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('min_purchase')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('coffee_shop_id');
            $table->index(['start_date', 'end_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
