<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Str;
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
            $query->where('language_id', App::getLocale())->get();}])->get();;
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
            'cuisine_key' => $uuid
        ];
        
        Cuisine::create($data);

        return redirect()->route('cuisines');
    }

    public function getById($id) {
        $languages = Language::with(['translation' => function($query) use ($id){
            $query->where('key', $id)->get();
        }])->get();
        return view('cuisines.modals.edit', [
            'id' => $id,
            'languages' => $languages
        ]);
    }

    public function update(Request $request, $id) {
        $list = [];
        foreach($request->value as $key => $value){
            $list[] = [
                'key' => $id,
                'value' => $value,
                'language_id' => $key
            ];
        }

        Translate::upsert($list, ['key', 'language_id'], ['value']);

        return redirect()->route('cuisines'); 
    }
    
    public function destroy($id) {
        Translate::where('key', $id)->delete();
        Cuisine::where('cuisine_key', $id)->delete();
        
        return redirect()->route('cuisines');
    }
}
