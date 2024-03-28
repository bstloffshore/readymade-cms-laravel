<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAboutUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menus_id');
            $table->string('title_en');
            $table->string('title_ar')->nullable();
            $table->text('description_en');
            $table->text('description_ar')->nullable();
            $table->string('icon_class')->nullable();
            $table->string('icon_file')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamp('created_on')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->index('menus_id');
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
        Schema::dropIfExists('about_us');
    }
}
