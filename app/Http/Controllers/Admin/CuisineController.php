<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\FunctionController;
use App\Models\Cuisine;
use App\Models\Translate;
use App\Models\Language;

class CuisineController extends Controller
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
        $cuisines = Cuisine::with([
            'translation' => function($query) { 
            $query->where('language_code', App::getLocale())->get();}])->get();;
        // return $categories;
        return view('cuisines.index', [
            'cuisines' => $cuisines
        ]);
    }

    public function create() {
        $languages = Language::all();
        return view('cuisines.modals.create',[
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
        $country = new Cuisine();
        $country->name = $nextVal;
        $country->save();
        return redirect()->route('cuisines');
    }

    public function getById($id) {
        $languages = Language::with(['translation' => function($query) use ($id){
            $query->where('id', $id)->get();
        }])->get();
        return view('cuisines.modals.edit', [
            'id' => $id,
            'languages' => $languages
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

        return redirect()->route('cuisines'); 
    }
    
    public function destroy($id) {
        Cuisine::destroy($id);
        return redirect()->route('cuisines');
    }
}
