<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('name');

            $table->string('slug')->unique();

            $table->string('sku')->unique();

            $table->longText('description')->nullable();

            $table->decimal('price', 15, 2);

            $table->decimal('discount_price', 15, 2)
                ->nullable();

            $table->integer('stock')->default(0);

            $table->string('thumbnail')->nullable();

            $table->boolean('is_featured')->default(false);

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index('category_id');
            $table->index('slug');
            $table->index('sku');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};