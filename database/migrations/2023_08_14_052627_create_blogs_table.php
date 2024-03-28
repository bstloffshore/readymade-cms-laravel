<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->string('menu_slug')->nullable();
            $table->string('title_en');
            $table->string('title_ar')->nullable();
            $table->string('blog_title_slug');
            $table->string('image');
            $table->string('web_image');
            $table->string('image_title');
            $table->string('image_alt');
            $table->text('short_description_en')->nullable();
            $table->text('short_description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('block_quote_en')->nullable();
            $table->text('block_quote_ar')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->smallInteger('sort_order')->default(0);
            $table->tinyInteger('status')->default(0)->comment('0: Inactive, 1: Active, 2: Pending');
            $table->tinyInteger('is_featured')->default(0)->comment('0: No, 1: Yes');
            $table->timestamp('created_on')->default(now());
            $table->index('menu_id');
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
        Schema::dropIfExists('blogs');
    }
}
