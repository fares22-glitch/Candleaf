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
        Schema::create('credit_cards', function (Blueprint $table) {
            $table->id();
            $table->string('card_number')->unique();
            $table->string('holder_name');
            $table->string('expiration');
            $table->string('cvv');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('credit_cards');
    }
};
