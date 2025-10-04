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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // id (primary key)
            $table->string('name'); // product name
            $table->decimal('price', 10, 2); // product price
            $table->unsignedInteger('stock')->default(0); // stock quantity
            $table->text('description')->nullable(); // optional description
            $table->string('image')->nullable(); // optional product image
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
