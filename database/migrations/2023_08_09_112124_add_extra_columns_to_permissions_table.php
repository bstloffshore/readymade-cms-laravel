<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraColumnsToPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table) {

            $table->string('display_name')->after('name')->nullable();
            $table->string('permission_slug')->after('display_name')->nullable();
            $table->unsignedBigInteger('module_settings_id')->nullable()->after('permission_slug');
            $table->string('module_name')->after('module_settings_id')->nullable();
            $table->string('module_slug')->after('module_name')->nullable();
            $table->tinyInteger('status')->after('module_slug')->default(0);
            $table->timestamp('created_on')->after('guard_name')->default(now());
            // Add index to the foreign key column
            $table->index('module_settings_id');

            // Define foreign key constraint
            $table->foreign('module_settings_id')
                  ->references('id')
                  ->on('module_settings')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn(['permission_slug','module_settings_id','module_name', 'module_slug','status','created_on']);
        });
    }
}
