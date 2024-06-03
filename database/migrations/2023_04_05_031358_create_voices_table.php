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
        Schema::create('voices', function (Blueprint $table) {
            $table->id();
            $table->string('voice');
            $table->string('voice_id');
            $table->string('gender');
            $table->string('language_code');            
            $table->string('vendor_id');
            $table->string('vendor');
            $table->string('vendor_img');
            $table->string('status')->default('active');
            $table->string('avatar_url')->nullable();
            $table->string('voice_type')->default('standard')->comment('standard|neural');
            $table->string('sample_url')->nullable();
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
        Schema::dropIfExists('voices');
    }
};
