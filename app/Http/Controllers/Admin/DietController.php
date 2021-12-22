<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Str;
use App\Models\Diet;
use App\Models\Food;
use App\Models\DietFood;
use App\Models\Translate;
use App\Models\Language;

class DietController extends Controller
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
        $diets = Diet::with([
            'translation' => function($query) { 
            $query->where('language_id', App::getLocale())->get();}])->get();;
        return view('diets.index', [
            'diets' => $diets
        ]);
    }

    public function create() {
        $languages = Language::all();
        $foods = Food::with([
            'translation' => function($query) { 
            $query->where('language_id', App::getLocale())->get();},
            'food_category' => function($query) { 
                $query->where('language_id', App::getLocale())->get();}])->get();
        return $foods;
        return view('diets.modals.create',[
            'languages' => $languages,
            'foods' => $foods
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
        
        $diet = new Diet();
        $diet->name = $nextVal;
        $diet->save();
        foreach($request->exclude as $key => $value){
            $data = [
                'diet_id' => $diet->id,
                'diet_food' => $value
            ];
            $diet_food = new DietFood($data);
            $diet_food->save();
        }
        
        // return redirect()->route('diets');
    }

    public function getById($id) {
        $languages = Language::with(['translation' => function($query) use ($id){
            $query->where('id', $id)->get(); }])->get();
        $foods = Food::with([
            'translation' => function($query) { 
            $query->where('language_code', App::getLocale())->get();},
            'food_category' => function($query) { 
                $query->where('language_code', App::getLocale())->get();},
            'diet_foods' => function($query) use ($id) {
                $query->where('diet_id', $id)->get();
            }])->get();


        
        // return $foods;
        return view('diets.modals.edit', [
            'id' => $id,
            'languages' => $languages,
            'foods' => $foods


        ]);
    }

    public function update(Request $request, $id) {
        
        $list = [];
        foreach($request->language_code as $key => $value){
            $list[] = [
                'id' => $id,
                'value' => $value,
                'language_code' => $key
            ];
        }

        Translate::upsert($list, ['id', 'language_code'], ['value']);

        DietFood::where('diet_id', $id)->delete();
        if(!empty($request->exclude)){
            foreach($request->exclude as $key => $value){
                $data = [
                    'diet_id' => $id,
                    'diet_food' => $value
                ];
                $diet_food = new DietFood($data);
                $diet_food->save();
            }
        }
        
        
        return redirect()->route('diets');
    }
    
    public function destroy($id) {
        Cuisine::destroy($id);
        return redirect()->route('cuisines');
    }
}
