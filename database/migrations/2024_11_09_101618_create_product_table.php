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
        Schema::create('product', function (Blueprint $table) {
            $table->id('id_product');
            $table->string('name')->unique();
            $table->longText('description')->nullable();
            $table->integer('rating')->default(0);
            $table->string('code')->unique();
            $table->integer('is_new')->default(0);
            $table->string('cover_image')->nullable();
            $table->integer('price')->nullable();
            $table->unsignedBigInteger('id_category');
            $table->foreign('id_category')->references('id_category')->on('category')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
