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
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->integer('referrer_id')->nullable();
            $table->string('referrer_email')->nullable();
            $table->integer('referred_id')->nullable();
            $table->string('referred_email')->nullable();
            $table->integer('rate')->nullable();
            $table->string('order_id')->nullable();
            $table->float('payment')->nullable();
            $table->float('commission')->nullable();
            $table->string('status')->nullable();
            $table->string('gateway')->nullable();
            $table->timestamp('purchase_date')->nullable();
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
        Schema::dropIfExists('referrals');
    }
};
