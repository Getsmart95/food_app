<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Language;
use App\Models\Translate;

class CountryController extends Controller
{
    public function all() {
        $countries = Country::all();
        return view('countries.index',[
            'countries' => $countries
        ]);
    }

    public function create() {
        $languages = Language::all();
        return view('countries.modals.create', [
            'languages' => $languages
        ]);
    }

    public function store(Request $request) {
        
        foreach($request->value as $key => $value){
            $data = [
                'value' => $value,
                'language_id' => $request->language_id[$key]
            ];
            $translate = new Translate($data);
            $translate->save();

            $country = new Country();
            $country->name = $translate->id;
            $country->save();
        }
    }
}
