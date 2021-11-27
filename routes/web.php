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
    return view('index');
});

Route::group([
    'namespace' => 'Admin',
    'middleware' => 'auth'
], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');


    
    Route::get('languages/', 'LanguageController@all')->name('languages');
    Route::get('languages/create', function() { return view('languages.modals.create'); })->name('language.create');
    Route::get('languages/getById{id}', function() { return view('languages.modals.edit'); })->name('language.getById');
    Route::post('languages/store', 'LanguageController@store')->name('language.store');
    Route::put('languages/{id}', 'LanguageControll@update')->name('language.update');

    Route::get('countries/', function() { return view('countries.index');})->name('countries');
    Route::get('countries/create', function() { return view('countries.modals.create'); })->name('country.create');
    Route::get('contries/edit', function() { return view('countries.modals.edit'); })->name('country.edit');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
