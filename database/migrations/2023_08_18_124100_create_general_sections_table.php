<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->unsignedBigInteger('menu_id');
            $table->string('menu_slug');
            $table->string('category_title_en');
            $table->string('category_title_ar')->nullable();
            $table->text('highlight_en')->nullable();
            $table->text('highlight_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->smallInteger('sort_order')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->string('image')->nullable();
            $table->string('icon_file')->nullable();
            $table->string('icon_class')->nullable();
            $table->index('menu_id');
            $table->index('parent_id');
            $table->index('category_title_en');
            $table->index('highlight_en');
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
        Schema::dropIfExists('general_sections');
    }
}
