<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_store', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->index();
            $table->integer('store_id')->index();
            $table->decimal('number', 10)->default(0);
            $table->integer('user_id')->index()->nullable();
            $table->decimal('amount', 10)->default(0);
            $table->decimal('price', 10)->default(0);
            $table->decimal('gain')->default(30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_store');
    }
};
