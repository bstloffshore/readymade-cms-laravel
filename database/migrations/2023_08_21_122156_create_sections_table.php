<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('general_sections_id');
            $table->string('section_title_en');
            $table->string('section_title_ar')->nullable();
            $table->string('image')->nullable();
            $table->string('icon_class')->nullable();
            $table->string('icon_file')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0: Inactive, 1: Active');
            $table->smallInteger('sort_order')->default(0);
            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->index('general_sections_id');
            $table->index('section_title_en');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
}
