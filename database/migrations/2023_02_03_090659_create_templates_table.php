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
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')->nullable();
            $table->longText('description')->nullable(); 
            $table->string('template_code');  
            $table->boolean('status')->default(true); 
            $table->boolean('professional')->default(false); 
            $table->boolean('new')->default(false); 
            $table->string('type')->default('original');
            $table->string('group'); 
            $table->string('slug'); 
            $table->string('package')->nullable()->default('all');
            $table->longText('fields')->nullable(); 
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
        Schema::dropIfExists('templates');
    }
};
