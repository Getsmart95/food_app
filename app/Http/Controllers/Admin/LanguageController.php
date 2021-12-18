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
        Language::create($request->all());
        
        return redirect()->route('languages');
    }

    public function getById($iso) {
        $language = Language::where('iso_code', $iso)->get();
        return view('languages.modals.edit', [
            'language' => $language
        ]);
    }

    public function update(Request $request, $iso) {
        Language::where('iso_code', $iso)->update([
            'name' => $request->name,
            'iso_code' => $request->code
        ]);

        return redirect()->route('languages');
    }

    public function destroy(Request $request, $iso) {
        Language::where('iso_code', $iso)->delete();
        return redirect()->back();
    }
}
