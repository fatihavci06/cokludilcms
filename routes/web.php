<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/','App\Http\Controllers\admin\IndexController@index')->name('admin.index');

    Route::prefix('slider')->group(function(){
         Route::get('/create','App\Http\Controllers\admin\slider\IndexController@create')->name('slider.create');
         Route::post('/store','App\Http\Controllers\admin\slider\IndexController@store')->name('slider.store');
         Route::get('/','App\Http\Controllers\admin\slider\IndexController@index')->name('slider.index');
        Route::get('/edit/{id}','App\Http\Controllers\admin\slider\IndexController@edit')->name('slider.edit');
        Route::get('/delete/{id}','App\Http\Controllers\admin\slider\IndexController@delete')->name('slider.delete');
        Route::post('/update/{id}/{language_id}','App\Http\Controllers\admin\slider\IndexController@update')->name('slider.update'); 
        Route::post('/data','App\Http\Controllers\admin\slider\IndexController@data')->name('slider.data');        
    });
    Route::prefix('services')->group(function(){
         Route::get('/create','App\Http\Controllers\admin\services\IndexController@create')->name('services.create');
         Route::post('/store','App\Http\Controllers\admin\services\IndexController@store')->name('services.store');
         Route::get('/','App\Http\Controllers\admin\services\IndexController@index')->name('services.index');
        Route::get('/edit/{id}','App\Http\Controllers\admin\services\IndexController@edit')->name('services.edit');
        Route::get('/delete/{id}','App\Http\Controllers\admin\services\IndexController@delete')->name('services.delete');
        Route::post('/update/{id}}','App\Http\Controllers\admin\services\IndexController@update')->name('services.update'); 
        Route::post('/data','App\Http\Controllers\admin\slider\IndexController@data')->name('services.data');        
    });
    Route::prefix('language')->group(function(){
         Route::get('/create','App\Http\Controllers\admin\language\IndexController@create')->name('language.create');
         Route::post('/store','App\Http\Controllers\admin\language\IndexController@store')->name('language.store');
    });

});