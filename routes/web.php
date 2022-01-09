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
        // Recipes
        Route::get('recipes', 'RecipeController@all')->name('recipes');
        Route::get('recipes/create', 'RecipeController@create')->name('recipe.create');
        Route::get('recipes/getById/{id}', 'RecipeController@getById')->name('recipe.getById');
        Route::post('recipes/store', 'RecipeController@store')->name('recipe.store');
        Route::put('recipes/update/{id}', 'RecipeController@update')->name('recipe.update');
        Route::delete('recipes/destroy/{id}', 'RecipeController@destroy')->name('recipe.destroy');
        // Difficulties
        Route::get('difficulty', 'DifficultyController@all')->name('difficulties');
        Route::get('difficulty/create', 'DifficultyController@create')->name('difficulty.create');
        Route::get('difficulty/getById/{id}', 'DifficultyController@getById')->name('difficulty.getById');
        Route::post('difficulty/store', 'DifficultyController@store')->name('difficulty.store');
        Route::put('difficulty/update/{id}', 'DifficultyController@update')->name('difficulty.update');
        Route::delete('difficulty/destroy/{id}', 'DifficultyController@destroy')->name('difficulty.destroy');
        // Statuses
        Route::get('statuses', 'StatusController@all')->name('statuses');
        Route::get('statuses/create', 'StatusController@create')->name('status.create');
        Route::get('statuses/getById/{id}', 'StatusController@getById')->name('status.getById');
        Route::post('statuses/store', 'StatusController@store')->name('status.store');
        Route::put('statuses/update/{id}', 'StatusController@update')->name('status.update');
        Route::delete('statuses/destroy/{id}', 'StatusController@destroy')->name('status.destroy');
        // Reasons
        Route::get('reasons', 'ReasonController@all')->name('reasons');
        Route::get('reasons/create', 'ReasonController@create')->name('reason.create');
        Route::get('reasons/getById/{id}', 'ReasonController@getById')->name('reason.getById');
        Route::post('reasons/store', 'ReasonController@store')->name('reason.store');
        Route::put('reasons/update/{id}', 'ReasonController@update')->name('reason.update');
        Route::delete('reasons/destroy/{id}', 'ReasonController@destroy')->name('reason.destroy');

    });
});



require __DIR__.'/auth.php';
