<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Translate;
use App\Models\Language;

class CategoryController extends Controller
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
        $categories = Category::with([
            'translation' => function($query) { 
            $query->where('language_id', App::getLocale())->get();}])->get();;
        // return $categories;
        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    public function create() {
        $languages = Language::all();
        return view('categories.modals.create',[
            'languages' => $languages
        ]);
    }


    public function store(Request $request) {
        $uuid = Str::uuid();;
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
            'category_key' => $uuid
        ];
        
        Category::create($data);
        
        return redirect()->route('categories');
    }

    public function getById($id) {
        $languages = Language::with(['translation' => function($query) use ($id){
            $query->where('key', $id)->get();
        }])->get();
        return view('categories.modals.edit', [
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
                'language_id' => $key,
                'description' => $request->description[$key]
            ];
        }

        Translate::upsert($list, ['key', 'language_id'], ['value', 'description']);
        return redirect()->route('categories');
    }
    
    public function destroy($id) {
        Translate::where('key', $id)->delete();
        Category::where('category_key', $id)->delete();
        
        return redirect()->route('categories');
    }
}
