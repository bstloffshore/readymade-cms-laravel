<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('first_title_en')->nullable();
            $table->string('first_title_ar')->nullable();
            $table->string('second_title_en')->nullable();
            $table->string('second_title_ar')->nullable();
            $table->string('third_title_en')->nullable();
            $table->string('third_title_ar')->nullable();
            $table->string('image');
            $table->string('image_alt')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
