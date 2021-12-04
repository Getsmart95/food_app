<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Country;
use App\Models\Language;
use App\Models\Translate;

class CountryController extends Controller
{
    public function all() {
        $countries = Country::with(['translation' => function($query) { 
            $query->where('language_code', App::getLocale())
            ->where('id',1)->get();}])->where('id', 49)->get();
        // return $countries;
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
        $nextVal = $this->getNextVal();
        foreach($request->value as $key => $value){
            $data = [
                'id' => $nextVal,
                'value' => $value,
                'language_code' => $request->language_code[$key]
            ];
            //return $data;
            $translate = new Translate($data);
            $translate->save();
            
            $country = new Country();
            $country->name = $translate->id;
            $country->save();
        }
    }

    public function getNextVal() {
        $nextVal = Translate::max('id');
        if( !empty($nextVal) ) { 
            return $nextVal + 1;
        } else {
            return 1;
        };
    }
}
