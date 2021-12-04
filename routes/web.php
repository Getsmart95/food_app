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
 Route::get('/index', function () {
    return LaravelLocalization::setLocale();
});


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function(){ 
    // Localization
    Route::get('language/{lang}', 'LocalizationController@switchLanguage')->name('language.switch');

    Route::get('/welcome', function () {
        return LaravelLocalization::setLocale();
    })->name('welcome');

    Route::group([
        'namespace' => 'Admin',
        'middleware' => 'auth'
    ], function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        });
    
        Route::get('next/', 'CountryController@getNextVal');

        // Languages
        Route::get('languages/', 'LanguageController@all')->name('languages');
        Route::get('languages/create', 'LanguageController@create')->name('language.create');
        Route::get('languages/getById/{id}', 'LanguageController@getById')->name('language.getById');
        Route::post('languages/store', 'LanguageController@store')->name('language.store');
        Route::put('languages/update/{id}', 'LanguageController@update')->name('language.update');
        Route::delete('languages/destroy/{id}', 'LanguageController@destroy')->name('language.destroy');
        // Countries
        Route::get('countries/', 'CountryController@all')->name('countries');
        Route::get('countries/create', 'CountryController@create')->name('country.create');
        Route::get('contries/getById/{id}', 'CountryController@getById')->name('country.getById');
        Route::post('countries/store', 'CountryController@store')->name('country.store');
        Route::put('countries/update/{id}', 'CountryController@update')->name('country.update');
        Route::delete('countries/destroy/{id}', 'CountryController@destroy')->name('country.destroy');
        // Categories
        Route::get('categories', 'CategoryController@all')->name('categories');
        Route::get('categories/create', 'CategoryController@create')->name('category.create');
        Route::get('categories/getById/{id}', 'CategoryController@getById')->name('category.getById');
        Route::post('categories/store', 'CategoryController@store')->name('category.store');
        Route::put('categories/update/{id}', 'CategoryController@update')->name('category.update');
        Route::delete('categories/destroy/{id}', 'CategoryController@destroy')->name('category.destroy');

    });
});



require __DIR__.'/auth.php';
