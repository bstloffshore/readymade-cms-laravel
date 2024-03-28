<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->string('menu_name_en');
            $table->string('menu_name_ar')->nullable();
            $table->string('slug');
            $table->string('link')->nullable();
            $table->string('image')->nullable();
            $table->string('image_path')->nullable();
            $table->tinyText('short_description_en')->nullable();
            $table->tinyText('short_description_ar')->nullable();
            $table->tinyInteger('display_in_nav_bar')->default(0);
            $table->tinyInteger('display_in_seo')->default(0);
            $table->tinyInteger('display_in_footer')->default(0);
            $table->smallInteger('sort_order')->default(0);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('menus');
    }
}
