<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\FunctionController;
use App\Models\FoodCategory;
use App\Models\Translate;
use App\Models\Language;

class FoodCategoryController extends Controller
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
        $categories = FoodCategory::with([
            'translation' => function($query) { 
            $query->where('language_code', App::getLocale())->get();}])->get();;
        // return $categories;
        return view('food-categories.index', [
            'categories' => $categories
        ]);
    }

    public function create() {
        $languages = Language::all();
        return view('food-categories.modals.create',[
            'languages' => $languages
        ]);
    }


    public function store(Request $request) {
        $nextVal = $this->otherFunc->getNextVal();
        foreach($request->value as $key => $value){
            $data = [
                'id' => $nextVal,
                'value' => $value,
                'language_code' => $request->language_code[$key]
            ];
            $translate = new Translate($data);
            $translate->save();
        }
        $country = new FoodCategory();
        $country->name = $nextVal;
        $country->save();
        return redirect()->route('foods.categories');
    }

    public function getById($id) {
        $translates = Translate::whereId($id)->get();
        return view('food-categories.modals.edit', [
            'id' => $id,
            'translates' => $translates
        ]);
    }

    public function update(Request $request) {
        foreach($request->value as $key => $value){
            Translate::whereId($request->id)
                     ->where('language_code', $request->language_code[$key])
                     ->update([
                'value' => $value    
            ]);
        }     
        return redirect()->route('foods.categories');
    }
    
    public function destroy($id) {
        FoodCategory::destroy($id);
        return redirect()->route('foods.categories');
    }
}
