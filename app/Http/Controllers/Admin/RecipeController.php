<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Diet;
use App\Models\Language;
use App\Models\Translate;
use App\Models\Ingredient;
use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\Category;
use App\Models\Cuisine;
use App\Models\Energy;
use App\Models\Difficulty;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function all() {
        $diets = Diet::with([
            'translation' => function($query) { 
            $query->where('language_id', App::getLocale())->get();}])->get();
        return view('recipes.index', [
            'countries' => $diets
        ]);
    }

    public function create() {
        $languages = Language::all();
        $categories = Category::with([
            'translation' => function($query) { 
            $query->where('language_id', App::getLocale())->get();}])->get();
        $difficulties = Difficulty::all();
        $cuisines = Cuisine::with([
            'translation' => function($query) { 
            $query->where('language_id', App::getLocale())->get();}])->get();
        $foods = Food::with([
            'translation' => function($query) { 
            $query->where('language_id', App::getLocale())->get();}])->get();
        $food_categories = FoodCategory::with([
                'translation' => function($query) { 
                $query->where('language_id', App::getLocale())->get();}
            ])->get();;
        // return $foods;
        return view('recipes.modals.create',[
            'categories' => $categories,
            'difficulties' => $difficulties,
            'cuisines' => $cuisines,
            'foods' => $foods,
            'languages' => $languages
        ]);
    }

    public function store(Request $request) {
        // return $request;
        $uuid = Str::uuid();
        foreach($request->value as $key => $value){
            $data = [
                'key' => $uuid,
                'value' => $value,
                'description' => $request->description[$key],
                'language_id' => $request->language_id[$key]
            ];
            Translate::create($data);
        }
        
        $uuid_energy = Str::uuid();
        foreach($request->value as $key => $value){
            $data = [
                'key' => $uuid_energy,
                'value' => $value,
                'language_id' => $request->language_id[$key]
            ];
            Translate::create($data);
        }

        $data = [
            'energy_key' => $uuid_energy,
            'calories' => $request->calories,
            'fats' => $request->fats,
            'carbohydrates' => $request->carbohydrates,
            'proteins' => $request->proteins
        ];

        Energy::create($data);

        $store = [
            'cooking_time' => $request->cooking_time,
            'views' => 0,
            'likes' => 0,
            'dislikes' => 0,
            'is_active' => true,
            'difficult_id' => $request->difficult,
            'recipe_key' => $uuid,
            'category_key' => $request->food_category_key,
            'cuisine_key' => $request->cuisine_key,
            'energy_key' => $uuid_energy
        ];

        Recipe::create($store);
        
        // return redirect()->route('diets');
    }

}
