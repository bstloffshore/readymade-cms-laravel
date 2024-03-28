<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChangeStatusController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ModuleSettingController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\OfficeLocationsController;
use App\Http\Controllers\SlidersController;
use App\Http\Controllers\SiteSettingsController;
use App\Http\Controllers\GeneralSectionsController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\LeadsController;
use App\Http\Controllers\LeadsSlidersController;
use App\Http\Controllers\ContactUsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
Route::prefix('admin')->middleware(['basicAuth','auth','verified'])->group(function ()
{
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('changeStatus', [ChangeStatusController::class,'changeStatus'])->name('status.changeStatus');
    Route::resource('menus', MenuController::class);
    Route::post('/menus/delete-selected', [MenuController::class, 'deleteSelected'])->name('delete-selected-menus');

    // RolesController
    Route::resource('roles', RolesController::class);
    Route::post('/updateRole', [RolesController::class, 'update'])->name('roles.updateRole');
    Route::post('/updateUserGroup', [RolesController::class, 'updateUserGroup'])->name('roles.updateUserGroup');
    Route::get('/userpermissions/{id}', [RolesController::class, 'userRolePermission'])->name('roles.userpermissoins');

    // ModuleSettingController
    Route::resource('module-settings', ModuleSettingController::class);
    Route::post('/updateModuleSetting', [ModuleSettingController::class, 'update'])->name('module-settings.updateModuleSetting');
    Route::post('/module-settings/delete-selected', [ModuleSettingController::class, 'deleteSelected'])->name('delete-selected-module-settings');

     // UsersController
     Route::resource('users', UsersController::class);
     Route::post('/updateUser', [UsersController::class, 'update'])->name('users.updateUser');
     Route::get('/changePasswordByAdmin/{id}', [UsersController::class, 'changePasswordByAdmin'])->name('users.changePasswordByAdmin');
     Route::post('/updateChnagePasswordByAdmin', [UsersController::class, 'updateChnagePasswordByAdmin'])->name('users.updateChnagePasswordByAdmin');
     Route::post('/users/delete-selected', [UsersController::class, 'deleteSelected'])->name('users.delete-selected');
     Route::resource('countries', CountryController::class);
     Route::resource('sliders', SlidersController::class);
     Route::resource('office-locations', OfficeLocationsController::class);
     Route::resource('galleries', GalleryController::class);
     Route::resource('seo', SeoController::class);
     Route::get('site-settings', [SiteSettingsController::class,'create'])->name('site-settings.create');
     Route::post('/insertSiteSetting', [SiteSettingsController::class, 'store'])->name('site-settings.store');
     Route::resource('general-sections', GeneralSectionsController::class);
     Route::post('/updateGeneralSection', [GeneralSectionsController::class, 'update'])->name('general-sections.updateGeneralSection');
     Route::resource('sections', SectionsController::class);
     Route::post('/updateSection', [SectionsController::class, 'update'])->name('sections.updateSection');
     Route::resource('leads', LeadsController::class);
     Route::resource('lead-sliders', LeadsSlidersController::class);
     Route::resource('contact-us', ContactUsController::class);


});

