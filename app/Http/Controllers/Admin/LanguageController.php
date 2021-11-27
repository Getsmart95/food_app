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

    public function store(Request $request) {
        $language = new Language($request->all());

        $language->save();
    }

    public function getById($id) {
        $language = Language::whereID($id)->first();
        return view('languages.modals.edit', [
            'language' => $language
        ]);
    }

    
}
