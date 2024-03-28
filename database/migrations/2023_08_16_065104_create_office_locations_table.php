<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class CreateOfficeLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_locations', function (Blueprint $table) {
            $table->id();
            $table->tinyText('address_en');
            $table->tinyText('address_ar')->nullable();
            $table->string('address_icon')->nullable();
            $table->string('email');
            $table->string('email_icon')->nullable();
            $table->string('tel_number')->nullable();
            $table->string('fax_number')->nullable();
            $table->string('marketing_gsm')->nullable();
            $table->string('phone_icon')->nullable();
            $table->text('map_link')->nullable();
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
        Schema::dropIfExists('office_locations');
    }
}
