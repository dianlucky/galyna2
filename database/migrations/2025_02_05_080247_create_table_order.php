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
        Schema::create('order', function (Blueprint $table) {
            $table->id('id_order');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('message')->nullable();
            $table->string('status')->default('pending');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_product');
            $table->foreign('id_product')->references('id_product')->on('product')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('quantity');
            $table->integer('total');
            $table->string('code');
            $table->string('transaction_token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
