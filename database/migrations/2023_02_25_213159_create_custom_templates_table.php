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
        Schema::create('custom_templates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('icon')->nullable();
            $table->longText('description')->nullable(); 
            $table->string('template_code')->nullable(); 
            $table->boolean('status')->default(true); 
            $table->boolean('professional')->default(false); 
            $table->boolean('new')->default(false); 
            $table->string('group')->nullable(); 
            $table->string('slug')->nullable(); 
            $table->string('type')->default('custom'); 
            $table->longText('prompt')->nullable(); 
            $table->boolean('tone')->default(false); 
            $table->longText('fields')->nullable(); 
            $table->string('package')->nullable()->default('all');
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
        Schema::dropIfExists('custom_templates');
    }
};
