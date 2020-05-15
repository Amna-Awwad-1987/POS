<?php

//use Illuminate\Support\Facades\Route;

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
use Illuminate\Support\Facades\Route;
//use Mcamara\LaravelLocalization\LaravelLocalization;

    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){

            Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function(){
                Route::get('/' ,'DashboardController@index')->name('welcome');
                Route::resource('users' ,'UserController')->except('show');
                Route::resource('categories' ,'CategoryController')->except('show');
                Route::get('categories/image','CategoryController@image_editor');
                Route::resource('products' ,'ProductController')->except('show');
                Route::resource('clients' ,'ClientController')->except('show');
                Route::resource('clients.orders' ,'Client\OrderController')->except('show');
                Route::resource('orders' ,'OrderController');
                Route::get('orders/{order}/products' ,'OrderController@products')->name('orders.products');

                });
});


