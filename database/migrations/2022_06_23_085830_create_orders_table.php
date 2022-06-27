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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('address', 100);
            $table->string('typeIdentity', 100);
            $table->string('numberIdentity', 100);
            $table->string('phone', 100);
            $table->string('status', 100)->default("order");
            $table->string('date', 100)->nullable();
            $table->string('time', 100)->nullable();
            $table->string('day', 100)->nullable();
            $table->string('teknisi', 100)->nullable();
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
        Schema::dropIfExists('orders');
    }
};
