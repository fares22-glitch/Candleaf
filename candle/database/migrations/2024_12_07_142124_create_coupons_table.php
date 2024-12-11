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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key for the user
            $table->string('coupon_code'); // Unique coupon code
            $table->decimal('discount', 8, 2); // Discount value (percentage or flat amount)
            $table->integer('usage_count')->default(0); // Number of times this coupon has been used
            $table->timestamps();

            // Foreign key constraint referencing the users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Add unique constraint to coupon_code to avoid duplicates
            $table->unique('coupon_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
};
