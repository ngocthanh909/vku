<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController as ADC;
use App\Http\Controllers\UserController as User;
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


Route::prefix('/admin')->group(function () {
    Route::prefix('cmscategory')->group(function () {
        Route::get('/', [ADC::class, 'cmsCategoryIndex'])->name('admin.cmscategory.index');
        Route::get('/create', [ADC::class, 'cmsCategoryCreate'])->name('admin.cmscategory.create');
        
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
});
// Route::prefix('/')->group(function(){
//     Route::get('/', [User::class, 'index']);
// });

Route::domain('vkudemo.test')->group(function () {
    Route::get('/', [User::class, 'index']);
    Route::get('/browse', [User::class, 'postBrowse']);
    Route::get('/post/{slug}', [User::class, 'postView']);

});

Route::domain('{sub}.vkudemo.test')->group(function ($sub) {
    Route::get('/', [User::class, 'index']);
    Route::get('/browse', [User::class, 'postBrowse']);
});
Route::get('/crawler', [User::class, 'crawler']);