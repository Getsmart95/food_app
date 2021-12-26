<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Models\Diet;
use App\Models\Language;
use App\Models\Food;
class RecipeController extends Controller
{
    public function all() {
        $diets = Diet::with([
            'translation' => function($query) { 
            $query->where('language_id', App::getLocale())->get();}])->get();;
        return view('recipes.index', [
            'countries' => $diets
        ]);
    }

    public function create() {
        $languages = Language::all();
        $foods = Food::with([
            'translation' => function($query) { 
            $query->where('language_id', App::getLocale())->get();},
            'food_category' => function($query) { 
                $query->where('language_id', App::getLocale())->get();}])->get();
        // return $foods;
        return view('recipes.modals.create',[
            'languages' => $languages,
            'foods' => $foods
        ]);
    }
}
