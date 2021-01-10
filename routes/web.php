<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController as ADC;
use App\Http\Controllers\UserController as User;
use App\Http\Controllers\AuthController as Auth;
use App\Http\Controllers\CKEditorController as CKEditor;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::prefix('/admin')->middleware('adminAuth')->group(function () {
    Route::get('/', [ADC::class, 'adminDashboard'])->name('admin.dashboard');
    Route::prefix('cmscategory')->group(function () {
        Route::get('/', [ADC::class, 'cmsCategoryIndex'])->name('admin.cmscategory.index');
        Route::get('/create', [ADC::class, 'cmsCategoryCreate'])->name('admin.cmscategory.create');
        Route::get('/edit/{id}', [ADC::class, 'cmsCategoryEdit'])->name('admin.cmscategory.edit');
        // Resource
        Route::post('/store', [ADC::class, 'cmsCategoryStore'])->name('admin.cmscategory.store');
        Route::post('/update/{id}', [ADC::class, 'cmsCategoryUpdate'])->name('admin.cmscategory.update');
        Route::get('/delete/{id}', [ADC::class, 'cmsCategoryDelete'])->name('admin.cmscategory.delete');
        
    });
    Route::prefix('cms')->group(function () {
        Route::get('/', [ADC::class, 'cmsIndex'])->name('admin.cms.index');
        Route::get('/create', [ADC::class, 'cmsCreate'])->name('admin.cms.create');
        Route::get('/edit/{id}', [ADC::class, 'cmsEdit'])->name('admin.cms.edit');
        // Resource
        Route::post('/store', [ADC::class, 'cmsStore'])->name('admin.cms.store');
        Route::post('/remove', [ADC::class, 'cmsStore'])->name('admin.cms.remove');
        Route::post('/update/{id}', [ADC::class, 'cmsUpdate'])->name('admin.cms.update');
        Route::get('/delete/{id}', [ADC::class, 'cmsDelete'])->name('admin.cms.delete');
        Route::get('/json', [ADC::class, 'cmsJson']);
    });
    Route::prefix('user')->group(function () {
        Route::get('/', [ADC::class, 'userIndex'])->name('admin.user.index');
        // Route::get('/create', [ADC::class, 'cmsCategoryCreate'])->name('admin.cmscategory.create');
        Route::get('/edit/{id}', [ADC::class, 'userEdit'])->name('admin.user.edit');
        // // Resource
        Route::post('/store', [ADC::class, 'userStore'])->name('admin.user.store');
        Route::post('/update/{id}', [ADC::class, 'userUpdate'])->name('admin.user.update');
        Route::get('/reset/{id}', [ADC::class, 'userReset'])->name('admin.user.reset');
        Route::get('/delete/{id}', [ADC::class, 'userDelete'])->name('admin.user.delete');        
    });
});
Route::domain('vkudemo.test')->group(function () {
    Route::get('/', [User::class, 'index']);
    Route::get('/danhmuc', [User::class, 'postBrowse']);
    Route::get('/baiviet/{slug}', [User::class, 'postView'])->name('postView');
});

Route::domain('{sub}.vkudemo.test')->group(function ($sub) {
    Route::get('/', [User::class, 'index']);
    Route::get('/browse', [User::class, 'postBrowse']);
});
Route::get('/crawler', [User::class, 'crawler']);

Route::post('ckeditor/image_upload', [CKEditor::class,'upload'])->name('upload');

// LOGIN CONTROLLER
Route::get('/admin/login', function(){
    return view('admin.Auth.login');
});
Route::post('/admin/login', [Auth::class,'login'])->name('admin.login');
Route::get('/admin/logout', [Auth::class,'logout'])->name('admin.logout');