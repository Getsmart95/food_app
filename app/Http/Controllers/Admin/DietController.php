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
            $query->where('language_id', App::getLocale())->get();}])->get();
                
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
        // return $foods;
        return view('diets.modals.create',[
            'languages' => $languages,
            'foods' => $foods
        ]);
    }


    public function store(Request $request) {
        // return $request;
        $uuid = Str::uuid();
        foreach($request->value as $key => $value){
            $data = [
                'key' => $uuid,
                'value' => $value,
                'language_id' => $request->language_id[$key]
            ];
            Translate::create($data);
        }
        
        $data = [
            'diet_key' => $uuid
        ];

        Diet::create($data);
  
        foreach($request->exclude as $key => $value){
            $data = [
                'diet_key' => $uuid,
                'food_key' => $value
            ];
            $diet_food = new DietFood($data);
            $diet_food->save();
        }
        
        return redirect()->route('diets');
    }

    public function getById($id) {
        $languages = Language::with(['translation' => function($query) use ($id){
            $query->where('key', $id)->get(); }])->get();
        $foods = Food::with([
            'translation' => function($query) { 
            $query->where('language_id', App::getLocale())->get();},
            'food_category' => function($query) { 
                $query->where('language_id', App::getLocale())->get();},
            ])->get();
        $diet_foods = DietFood::where('diet_key', $id)->get();
        

        

        return view('diets.modals.edit', [
            'id' => $id,
            'languages' => $languages,
            'foods' => $foods,
            'diet_foods' => $diet_foods


        ]);
    }

    public function update(Request $request, $id) {
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

        DietFood::where('diet_key', $id)->delete();
        if(!empty($request->exclude)){
            foreach($request->exclude as $key => $value){
                $data = [
                    'diet_key' => $id,
                    'food_key' => $value
                ];
                $diet_food = new DietFood($data);
                $diet_food->save();
            }
        }
        
        
        return redirect()->route('diets');
    }
    
    public function destroy($id) {
        Diet::where('diet_key', $id)->delete();
        DietFood::where('diet_key', $id)->delete();
        Translate::where('key', $id)->delete();

        return redirect()->route('diets');
    }
}
