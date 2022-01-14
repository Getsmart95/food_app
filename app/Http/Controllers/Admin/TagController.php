<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use App\Models\Tag;
use App\Models\Language;
use App\Models\Translate;

class TagController extends Controller
{
    public function all() {
        $tags = Tag::with([
            'translation' => function($query) { 
            $query->where('language_id', App::getLocale())->get();}])->get();
        // return $Tages;
        return view('tags.index',[
            'tags' => $tags
        ]);
    }

    public function getById($id) {
        $languages = Language::with(['translation' => function($query) use ($id){
            $query->where('key', $id)->get();
        }])->get();

        $tag = Tag::where('Tag_key', $id)->first();
        return view('tags.modals.edit', [
            'id' => $id,
            'languages' => $languages,
            'tag' => $tag
        ]);
    }

    public function create() {
        $languages = Language::all();
        return view('tags.modals.create', [
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

        $data_store = [
            'tag_key' => $uuid
        ];
        Tag::create($data_store);

        return redirect()->route('tags');
    }

    public function update(Request $request, $id) {
        // return $request;
        foreach($request->value as $key => $value){
            $list[] = [
                'key' => $id,
                'value' => $value,
                'language_id' => $key
            ];
        }
        // return $list;
        Translate::upsert($list, ['key', 'language_id'], ['value']);
        Tag::where('tag_key', $id)->update([
            'code' => $request->code
        ]);
        
        return redirect()->route('tags'); 
    }

    public function destroy($id, Request $request) {
        Tag::where('tag_key', $id)->delete();
        Translate::where('key', $id)->delete();
        return redirect()->back();
    }
}
