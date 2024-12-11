<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('informations', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // Foreign key to users
            $table->unsignedBigInteger('cart_id'); // Foreign key to cart
            $table->string('address');
            $table->string('phone_number');
            $table->string('city');
            $table->string('postal_code');
            $table->string('country');
            $table->boolean('save_for_checkout')->default(false);
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cart_id')->references('id')->on('cart')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('informations');
    }
};
