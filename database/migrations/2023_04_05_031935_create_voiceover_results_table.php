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
        Schema::create('voiceover_results', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('language');
            $table->string('language_flag')->nullable();
            $table->string('voice');
            $table->string('voice_id')->nullable();
            $table->string('gender')->nullable();
            $table->longText('text')->nullable();
            $table->longText('text_raw')->nullable();
            $table->string('file_name')->nullable();
            $table->string('result_url')->nullable();
            $table->string('result_ext')->nullable();
            $table->string('storage')->nullable()->comment('local|s3|wasabi');
            $table->string('title')->nullable();
            $table->string('vendor')->nullalbe()->comment('azure|gcp');
            $table->string('vendor_id')->nullable()->comment('azure_nrl|gcp_nrl');
            $table->integer('characters')->nullable();;
            $table->string('voice_type')->comment('standard|neural');
            $table->string('plan_type')->comment('free|paid');
            $table->string('audio_type')->nullable();
            $table->string('mode')->nullable();
            $table->string('project')->nullable();
            $table->dateTime('expires_at')->nullable();
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
        Schema::dropIfExists('voiceover_results');
    }
};
