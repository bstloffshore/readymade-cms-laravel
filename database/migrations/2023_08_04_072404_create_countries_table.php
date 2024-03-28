<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('country_name_en');
            $table->string('country_name_ar')->nullable();
            $table->string('country_iso_code_en')->nullable();
            $table->string('country_iso_code_ar')->nullable();
            $table->string('country_slug');
            $table->smallInteger('sort_order')->default(0);
            $table->tinyInteger('status')->comment('0: Inactive, 1: Active, 2: Pending');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
        // $permissions = [
        //     'index-countries',
        //     'create-countries',
        //     'edit-countries',
        //     'delete-countries',
        //     'view-countries',
        // ];

        // foreach ($permissions as $permission) {
        //     \Spatie\Permission\Models\Permission::updateOrCreate(['name' => $permission]);
        // }
        // $permissions = \Spatie\Permission\Models\Permission::pluck('id','id')->all();
        // $role = \Spatie\Permission\Models\Role::where(['name' => 'Admin'])->first();

        // if($role==null){
        //     DB::table('roles')->insert(['name' => 'Admin','guard_name'=>'web']);
        //     $role = \Spatie\Permission\Models\Role::where(['name' => 'Admin'])->first();
        //     $role->syncPermissions($permissions);
        // }else{
        //     $role->syncPermissions($permissions);
        // }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
