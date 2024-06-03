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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('job_role')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('status')->nullable();
            $table->string('group')->nullable();
            $table->string('workbook')->nullable();
            $table->integer('plan_id')->nullable();
            $table->string('plan_type')->nullable();
            $table->string('company')->nullable();
            $table->string('website')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
            $table->integer('available_words')->default(0);
            $table->integer('available_words_prepaid')->default(0);
            $table->integer('total_words')->default(0);
            $table->integer('available_images')->default(0);
            $table->integer('available_images_prepaid')->default(0);
            $table->integer('total_images')->default(0);
            $table->float('balance')->default(0.0);
            $table->integer('total_chars')->nullable()->default(0);
            $table->integer('available_chars')->default(0);
            $table->integer('available_chars_prepaid')->default(0);
            $table->decimal('total_minutes', 15, 3)->default(0);
            $table->decimal('available_minutes', 15, 3)->default(0);
            $table->decimal('available_minutes_prepaid', 15, 3)->default(0);
            $table->text('profile_photo_path')->nullable();
            $table->string('oauth_id')->nullable();
            $table->string('oauth_type')->nullable();     
            $table->timestamp('last_seen')->nullable();
            $table->text('google2fa_secret')->nullable();
            $table->boolean('google2fa_enabled')->nullable()->default(0);
            $table->string('referral_id')->nullable();
            $table->string('referred_by')->nullable();
            $table->string('referral_payment_method')->nullable();
            $table->string('referral_paypal')->nullable();
            $table->text('referral_bank_requisites')->nullable();
            $table->string('default_voiceover_language')->nullable();
            $table->string('default_voiceover_voice')->nullable();
            $table->integer('member_of')->nullable(); 
            $table->integer('member_limit')->default(0)->nullable(); 
            $table->boolean('member_use_credits_template')->default(1)->nullable(); 
            $table->boolean('member_use_credits_chat')->default(1)->nullable(); 
            $table->boolean('member_use_credits_code')->default(1)->nullable(); 
            $table->boolean('member_use_credits_voiceover')->default(1)->nullable(); 
            $table->boolean('member_use_credits_speech')->default(1)->nullable(); 
            $table->boolean('member_use_credits_image')->default(1)->nullable(); 
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
