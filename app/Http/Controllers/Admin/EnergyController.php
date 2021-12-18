<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\FunctionController;
use App\Models\Food;
use App\Models\Energy;
use App\Models\Translate;
use App\Models\Language;

class EnergyController extends Controller
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
        $energies = Food::with([
            'translation' => function($query) { 
            $query->where('language_code', App::getLocale())->get();},
            'food_category' => function($query) { 
                $query->where('language_code', App::getLocale())->get();}])->get();
        return view('energies.index', [
            'energies' => $energies
        ]);
    }

    public function create() {
        $languages = Language::all();
        $categories = FoodCategory::with([
            'translation' => function($query) { 
            $query->where('language_code', App::getLocale())->get();}])->get();

        return view('foods.modals.create',[
            'languages' => $languages,
            'categories' => $categories
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
        $food = new Food();
        $food->name = $nextVal;
        $food->food_category_id = $request->food_category_id;
        $food->save();
        return redirect()->route('foods');
    }

    public function getById($id) {
        $languages = Language::with(['translation' => function($query) use ($id){
            $query->where('id', $id)->get(); }])->get();
        $categories = FoodCategory::with('translation')->get();
        $food = Food::where('name', $id)->first();
        // return $food;
        // return $languages;
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
        foreach($request->language_code as $key => $value){
            $list[] = [
                'id' => $id,
                'value' => $value,
                'language_code' => $key
            ];
        }

        Translate::upsert($list, ['id', 'language_code'], ['value']);
        Food::where('name', $id)->update([
            'food_category_id' => $request->food_category_id
        ]);
        return redirect()->route('foods');
    }
    
    public function destroy($id) {
        Food::destroy($id);
        return redirect()->route('foods');
    }
}
