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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->longText('title')->nullable();
            $table->longText('input_text')->nullable();
            $table->longText('result_text')->nullable();
            $table->string('model')->nullable();
            $table->string('language')->nullable();
            $table->string('template_code')->nullable();
            $table->string('template_name')->nullable();
            $table->string('workbook')->nullable();
            $table->string('icon')->nullable();
            $table->string('group')->nullable();
            $table->string('language_name')->nullable();
            $table->string('language_flag')->nullable();
            $table->integer('tokens')->nullable();
            $table->integer('words')->nullable();
            $table->string('plan_type')->comment('free|paid')->default('free');
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
        Schema::dropIfExists('contents');
    }
};
