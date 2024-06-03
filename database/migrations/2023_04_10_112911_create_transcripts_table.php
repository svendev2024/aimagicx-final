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
        Schema::create('transcripts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->longText('url')->nullable();
            $table->longText('transcript')->nullable();
            $table->string('title')->nullable();
            $table->string('workbook')->nullable();
            $table->string('task')->nullable();
            $table->integer('words')->nullable();
            $table->string('format')->nullable();
            $table->string('audio_type')->nullable();
            $table->string('description')->nullable();
            $table->string('storage')->nullable()->comment('local|wasabi|aws');
            $table->decimal('length', 15, 3)->nullable();
            $table->string('plan_type')->nullable()->comment('free|paid');
            $table->string('size')->nullable();
            $table->string('file_name')->nullable();
            $table->string('temp_name')->nullable();
            $table->dateTime('expires_at')->nullable();
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
        Schema::dropIfExists('transcripts');
    }
};
