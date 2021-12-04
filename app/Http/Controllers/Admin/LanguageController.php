<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
class LanguageController extends Controller
{
    public function all() {
        $languages = Language::all();
        return view('languages.index',[
            'languages' => $languages
        ]);
    }

    public function create() {
        return view('languages.modals.create');
    }

    public function store(Request $request) {
        $language = new Language($request->all());
        $language->save();
        return redirect()->route('languages');
    }

    public function getById($id) {
        $language = Language::find($id);;
        return view('languages.modals.edit', [
            'language' => $language
        ]);
    }

    public function update(Request $request, $id) {
        Language::whereId($id)->update([
            'name' => $request->name,
            'code' => $request->code
        ]);

        return redirect()->route('languages');
    }

    public function destroy(Request $request, $id) {
        Language::destroy($id);
        return redirect()->back();
    }
}
