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
    
        Route::get('languages/', 'LanguageController@all')->name('languages');
        Route::get('languages/create', function() { return view('languages.modals.create'); })->name('language.create');
        Route::get('languages/getById/{id}', 'LanguageController@getById')->name('language.getById');
        Route::post('languages/store', 'LanguageController@store')->name('language.store');
        Route::put('languages/update/{id}', 'LanguageController@update')->name('language.update');
        Route::delete('languages/destroy/{id}', 'LanguageController@destroy')->name('language.destroy');
    
        Route::get('countries/', 'CountryController@all')->name('countries');
        Route::get('countries/create', 'CountryController@create')->name('country.create');
        Route::post('countries/store', 'CountryController@store')->name('country.store');
        Route::get('contries/edit', function() { return view('countries.modals.edit'); })->name('country.edit');
    });
});



require __DIR__.'/auth.php';
