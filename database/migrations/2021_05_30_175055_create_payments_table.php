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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('frequency')->nullable()->comment('prepaid|monthly|yearly');
            $table->string('order_id');
            $table->unsignedBigInteger('plan_id');
            $table->float('price');
            $table->string('currency');
            $table->string('gateway');
            $table->string('status')->comment('completed|cancelled|declined|failed|pending');
            $table->string('plan_name');
            $table->integer('words')->nullable()->default(0);
            $table->integer('images')->nullable()->default(0);
            $table->integer('characters')->nullable()->default(0);
            $table->integer('minutes')->nullable()->default(0);
            $table->dateTime('valid_until')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
