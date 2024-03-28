<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name_en');
            $table->string('site_name_ar')->nullable();
            $table->string('site_url')->nullable();
            $table->string('contact_number',30)->nullable();
            $table->string('telephone_number',30)->nullable();
            $table->string('whats_app_number',30)->nullable();
            $table->string('email')->nullable();
            $table->string('login_email')->nullable();
            $table->string('contactus_email')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->tinyText('company_address_en')->nullable();
            $table->tinyText('company_address_ar')->nullable();
            $table->tinyInteger('disable')->default(0)->comment('0: No, 1: Yes');
            $table->string('header_logo')->nullable();
            $table->string('footer_logo')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
}
