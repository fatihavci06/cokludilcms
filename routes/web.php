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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::group([
     'prefix' => LaravelLocalization::setLocale(),
     'middleware' => [ 'localeSessionRedirect', 'localizationRedirect' ]
], function() {
     Route::get('/{lang?}','App\Http\Controllers\front\IndexController@index')->name('front.index');
     //Route::get('/{dil}','App\Http\Controllers\front\IndexController@index');

    Route::get(LaravelLocalization::transRoute('routes.about'), 'App\Http\Controllers\front\IndexController@about');
    Route::get(LaravelLocalization::transRoute('routes.pages'), 'App\Http\Controllers\front\IndexController@pages')->name('front.page');
     Route::get(LaravelLocalization::transRoute('routes.map'), 'App\Http\Controllers\front\IndexController@map');
   Route::get(LaravelLocalization::transRoute('routes.contact'), 'App\Http\Controllers\front\IndexController@contact')->name('front.contact');
    //Route::get(LaravelLocalization::transRoute('routes.pages'), 'App\Http\Controllers\front\IndexController@pages');

    

    Route::get(LaravelLocalization::transRoute('routes.article'), function () {
        return 's';
    });
    
});





Auth::routes();







/*
 Route::group([
     'prefix' => LaravelLocalization::setLocale(),
     'middleware' => [ 'localeSessionRedirect', 'localizationRedirect' ]
], function() {
     Route::get('/','App\Http\Controllers\front\IndexController@index')->name('front.index');
     Route::get('/{dil}','App\Http\Controllers\front\IndexController@index');
     Route::get(LaravelLocalization::transRoute('routes.page'), function () {
        echo 's';
    });
}); 


*/
//Route::get('/{dil}','App\Http\Controllers\front\IndexController@index')->name('front.indexs');

Route::post('/offer','App\Http\Controllers\front\IndexController@offer')->name('front.offer');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/index','App\Http\Controllers\admin\IndexController@index')->name('admin.index');

    Route::prefix('slider')->group(function(){
         Route::get('/create','App\Http\Controllers\admin\slider\IndexController@create')->name('slider.create');
         Route::post('/store','App\Http\Controllers\admin\slider\IndexController@store')->name('slider.store');
         Route::get('/','App\Http\Controllers\admin\slider\IndexController@index')->name('slider.index');
        Route::get('/edit/{id}','App\Http\Controllers\admin\slider\IndexController@edit')->name('slider.edit');
        Route::get('/delete/{id}','App\Http\Controllers\admin\slider\IndexController@delete')->name('slider.delete');
        Route::post('/update/{id}/','App\Http\Controllers\admin\slider\IndexController@update')->name('slider.update'); 
        Route::post('/data','App\Http\Controllers\admin\slider\IndexController@data')->name('slider.data');    
        Route::get('/sortable','App\Http\Controllers\admin\slider\IndexController@sortable')->name('slider.sortable');    
    });
    Route::prefix('services')->group(function(){
         Route::get('/create','App\Http\Controllers\admin\services\IndexController@create')->name('services.create');
         Route::post('/store','App\Http\Controllers\admin\services\IndexController@store')->name('services.store');
         Route::get('/','App\Http\Controllers\admin\services\IndexController@index')->name('services.index');
        Route::get('/edit/{id}','App\Http\Controllers\admin\services\IndexController@edit')->name('services.edit');
        Route::get('/delete/{id}','App\Http\Controllers\admin\services\IndexController@delete')->name('services.delete');
        Route::post('/update/{id}}','App\Http\Controllers\admin\services\IndexController@update')->name('services.update'); 
        Route::post('/data','App\Http\Controllers\admin\services\IndexController@data')->name('services.data');        
    });
    Route::prefix('blogCategory')->group(function(){
         Route::get('/create','App\Http\Controllers\admin\blogCategory\IndexController@create')->name('blogCategory.create');
         Route::post('/store','App\Http\Controllers\admin\blogCategory\IndexController@store')->name('blogCategory.store');
         Route::get('/','App\Http\Controllers\admin\blogCategory\IndexController@index')->name('blogCategory.index');
        Route::get('/edit/{id}','App\Http\Controllers\admin\blogCategory\IndexController@edit')->name('blogCategory.edit');
        Route::get('/delete/{id}','App\Http\Controllers\admin\blogCategory\IndexController@delete')->name('blogCategory.delete');
        Route::post('/update/{id}}','App\Http\Controllers\admin\blogCategory\IndexController@update')->name('blogCategory.update'); 
        Route::post('/data','App\Http\Controllers\admin\blogCategory\IndexController@data')->name('blogCategory.data');        
    });
    Route::prefix('blog')->group(function(){
         Route::get('/create','App\Http\Controllers\admin\blog\IndexController@create')->name('blog.create');
         Route::get('/kategoricek','App\Http\Controllers\admin\blog\IndexController@kategoricek')->name('blog.kategoricek');
         Route::get('/kategoricekupdate','App\Http\Controllers\admin\blog\IndexController@kategoricekupdate')->name('blog.kategoricek.update');
         Route::post('/store','App\Http\Controllers\admin\blog\IndexController@store')->name('blog.store');
         Route::get('/','App\Http\Controllers\admin\blog\IndexController@index')->name('blog.index');
        Route::get('/edit/{id}','App\Http\Controllers\admin\blog\IndexController@edit')->name('blog.edit');
        Route::get('/delete/{id}','App\Http\Controllers\admin\blog\IndexController@delete')->name('blog.delete');
        Route::post('/update/{id}}','App\Http\Controllers\admin\blog\IndexController@update')->name('blog.update'); 
        Route::get('/data','App\Http\Controllers\admin\blog\IndexController@data')->name('blog.data');        
    });
    Route::prefix('page')->group(function(){
         Route::get('/create','App\Http\Controllers\admin\page\IndexController@create')->name('page.create');
         Route::post('/store','App\Http\Controllers\admin\page\IndexController@store')->name('page.store');
         Route::get('/','App\Http\Controllers\admin\page\IndexController@index')->name('page.index');
        Route::get('/edit/{id}','App\Http\Controllers\admin\page\IndexController@edit')->name('page.edit');
        Route::get('/delete/{id}','App\Http\Controllers\admin\page\IndexController@delete')->name('page.delete');
        Route::post('/update/{id}}','App\Http\Controllers\admin\page\IndexController@update')->name('page.update'); 
        Route::post('/data','App\Http\Controllers\admin\page\IndexController@data')->name('page.data');
         Route::get('/sortable','App\Http\Controllers\admin\page\IndexController@sortable')->name('page.sortable');


    });
    Route::prefix('project')->group(function(){
         Route::get('/create','App\Http\Controllers\admin\project\IndexController@create')->name('project.create');
         Route::post('/store','App\Http\Controllers\admin\project\IndexController@store')->name('project.store');
         Route::get('/','App\Http\Controllers\admin\project\IndexController@index')->name('project.index');
        Route::get('/edit/{id}','App\Http\Controllers\admin\project\IndexController@edit')->name('project.edit');
        Route::get('/delete/{id}','App\Http\Controllers\admin\project\IndexController@delete')->name('project.delete');
        Route::post('/update/{id}}','App\Http\Controllers\admin\project\IndexController@update')->name('project.update'); 
        Route::post('/data','App\Http\Controllers\admin\project\IndexController@data')->name('project.data');
         Route::get('/sortable','App\Http\Controllers\admin\project\IndexController@sortable')->name('project.sortable');


    });
    Route::prefix('takim')->group(function(){
         Route::get('/create','App\Http\Controllers\admin\takim\IndexController@create')->name('takim.create');
         Route::post('/store','App\Http\Controllers\admin\takim\IndexController@store')->name('takim.store');
         Route::get('/','App\Http\Controllers\admin\takim\IndexController@index')->name('takim.index');
        Route::get('/edit/{id}','App\Http\Controllers\admin\takim\IndexController@edit')->name('takim.edit');
        Route::get('/delete/{id}','App\Http\Controllers\admin\takim\IndexController@delete')->name('takim.delete');
        Route::post('/update/{id}}','App\Http\Controllers\admin\takim\IndexController@update')->name('takim.update'); 
        Route::post('/data','App\Http\Controllers\admin\takim\IndexController@data')->name('takim.data');
         Route::get('/sortable','App\Http\Controllers\admin\takim\IndexController@sortable')->name('takim.sortable');


    });
    Route::prefix('language')->group(function(){
         Route::get('/create','App\Http\Controllers\admin\language\IndexController@create')->name('language.create');
         Route::post('/store','App\Http\Controllers\admin\language\IndexController@store')->name('language.store');
         Route::get('/','App\Http\Controllers\admin\language\IndexController@index')->name('language.index');
        Route::get('/edit/{id}','App\Http\Controllers\admin\language\IndexController@edit')->name('language.edit');
        Route::get('/delete/{id}','App\Http\Controllers\admin\language\IndexController@delete')->name('language.delete');
        Route::post('/update/{id}}','App\Http\Controllers\admin\language\IndexController@update')->name('language.update'); 
        Route::post('/data','App\Http\Controllers\admin\language\IndexController@data')->name('language.data');
    });
    Route::prefix('setting')->group(function(){
         
         Route::get('/','App\Http\Controllers\admin\setting\IndexController@index')->name('setting.index');
        
        Route::post('/update/{id}}','App\Http\Controllers\admin\setting\IndexController@update')->name('setting.update'); 
        
    });
    Route::prefix('setting_text')->group(function(){
        
         Route::get('/','App\Http\Controllers\admin\setting_text\IndexController@index')->name('setting_text.index');
        Route::get('/edit/{id}','App\Http\Controllers\admin\setting_text\IndexController@edit')->name('setting_text.edit');
        Route::post('/update/{id}}','App\Http\Controllers\admin\setting_text\IndexController@update')->name('setting_text.update'); 
    });
    Route::prefix('referans')->group(function(){
         Route::get('/create','App\Http\Controllers\admin\referans\IndexController@create')->name('referans.create');
         Route::post('/store','App\Http\Controllers\admin\referans\IndexController@store')->name('referans.store');
         Route::get('/','App\Http\Controllers\admin\referans\IndexController@index')->name('referans.index');
        Route::get('/edit/{id}','App\Http\Controllers\admin\referans\IndexController@edit')->name('referans.edit');
        Route::get('/delete/{id}','App\Http\Controllers\admin\referans\IndexController@delete')->name('referans.delete');
        Route::post('/update/{id}}','App\Http\Controllers\admin\referans\IndexController@update')->name('referans.update');
        Route::get('/sortable','App\Http\Controllers\admin\referans\IndexController@sortable')->name('referans.sortable');
    });

});