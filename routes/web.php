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
        Route::get('languages/getByISO/{iso}', 'LanguageController@getByISO')->name('language.getByISO');
        Route::post('languages/store', 'LanguageController@store')->name('language.store');
        Route::put('languages/update/{iso}', 'LanguageController@update')->name('language.update');
        Route::delete('languages/destroy/{iso}', 'LanguageController@destroy')->name('language.destroy');
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
        // Cuisines
        Route::get('cuisines', 'CuisineController@all')->name('cuisines');
        Route::get('cuisines/create', 'CuisineController@create')->name('cuisine.create');
        Route::get('cuisines/getById/{id}', 'CuisineController@getById')->name('cuisine.getById');
        Route::post('cuisines/store', 'CuisineController@store')->name('cuisine.store');
        Route::put('cuisines/update/{id}', 'CuisineController@update')->name('cuisine.update');
        Route::delete('cuisines/destroy/{id}', 'CuisineController@destroy')->name('cuisine.destroy');
        // Foods
        Route::get('foods', 'FoodController@all')->name('foods');
        Route::get('foods/create', 'FoodController@create')->name('food.create');
        Route::get('foods/getById/{id}', 'FoodController@getById')->name('food.getById');
        Route::post('foods/store', 'FoodController@store')->name('food.store');
        Route::put('foods/update/{id}', 'FoodController@update')->name('food.update');
        Route::delete('foods/destroy/{id}', 'FoodController@destroy')->name('food.destroy');
        // Foods Category
        Route::get('foods/categories', 'FoodCategoryController@all')->name('foods.categories');
        Route::get('foods/categories/create', 'FoodCategoryController@create')->name('food.category.create');
        Route::get('foods/categories/getById/{id}', 'FoodCategoryController@getById')->name('food.category.getById');
        Route::post('foods/categories/store', 'FoodCategoryController@store')->name('food.category.store');
        Route::put('foods/categories/update/{id}', 'FoodCategoryController@update')->name('food.category.update');
        Route::delete('foods/categories/destroy/{id}', 'FoodCategoryController@destroy')->name('food.category.destroy');
        // Diets
        Route::get('diets', 'DietController@all')->name('diets');
        Route::get('diets/create', 'DietController@create')->name('diet.create');
        Route::get('diets/getById/{id}', 'DietController@getById')->name('diet.getById');
        Route::post('diets/store', 'DietController@store')->name('diet.store');
        Route::put('diets/update/{id}', 'DietController@update')->name('diet.update');
        Route::delete('diets/destroy/{id}', 'DietController@destroy')->name('diet.destroy');

    });
});



require __DIR__.'/auth.php';
