<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Str;
use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\Translate;
use App\Models\Language;

class FoodController extends Controller
{
    private $otherFunc;

    /**
     * PaymentStatusController constructor
     * 
     * @param \App\Http\Controllers\FunctionController $otherFunc
     */
    public function __construct(FunctionController $otherFunc)
    {
        $this->otherFunc = $otherFunc;
    }

    public function all() {
        $foods = Food::with([
            'translation' => function($query) { 
            $query->where('language_id', App::getLocale())->get();},
            'food_category' => function($query) { 
                $query->where('language_id', App::getLocale())->get();}])->get();
        return view('foods.index', [
            'foods' => $foods
        ]);
    }

    public function create() {
        $languages = Language::all();
        $categories = FoodCategory::with([
            'translation' => function($query) { 
            $query->where('language_id', App::getLocale())->get();}])->get();
                
        return view('foods.modals.create',[
            'languages' => $languages,
            'categories' => $categories
        ]);
    }


    public function store(Request $request) {
        // return $request;
        $uuid = Str::uuid();
        foreach($request->value as $key => $value){
            $data = [
                'key' => $uuid,
                'value' => $value,
                'language_id' => $request->language_id[$key],
                'description' => $request->description[$key]
            ];
            Translate::create($data);
        }

        $data = [
            'food_key' => $uuid,
            'food_category_key' => $request->food_category_key
        ];
        
        Food::create($data);

        return redirect()->route('foods');
    }

    public function getById($id) {
        $languages = Language::with(['translation' => function($query) use ($id){
            $query->where('key', $id)->get(); }])->get();
        $categories = FoodCategory::with('translation')->get();
        $food = Food::where('food_key', $id)->first();

        return view('foods.modals.edit', [
            'id' => $id,
            'languages' => $languages,
            'categories' => $categories,
            'food' => $food
        ]);
    }

    public function update(Request $request, $id) {
        // return $request;
        $list = [];
        foreach($request->value as $key => $value){
            $list[] = [
                'key' => $id,
                'value' => $value,
                'language_id' => $key,
                'description' => $request->description[$key]
            ];
        }

        Translate::upsert($list, ['key', 'language_id'], ['value', 'description']);
        Food::where('food_key', $id)->update([
            'food_category_key' => $request->food_category_key
        ]);
        return redirect()->route('foods');
    }
    
    public function destroy($id) {
        Translate::where('key', $id)->delete();
        Food::where('food_key', $id)->delete();

        return redirect()->route('foods');
    }
}
