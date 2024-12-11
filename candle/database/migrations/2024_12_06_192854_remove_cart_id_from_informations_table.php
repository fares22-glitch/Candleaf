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
        Schema::table('informations', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['cart_id']);
            // Drop the cart_id column
            $table->dropColumn('cart_id');
        });
    }

    public function down()
    {
        Schema::table('informations', function (Blueprint $table) {
            // Add the cart_id column back
            $table->unsignedBigInteger('cart_id')->nullable();

            // Restore the foreign key
            $table->foreign('cart_id')->references('id')->on('cart')->onDelete('cascade');
        });
    }
};
