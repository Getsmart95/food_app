<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\FunctionController;
use App\Models\Country;
use App\Models\Language;
use App\Models\Translate;

class CountryController extends Controller
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
        $countries = Country::with([
            'translation' => function($query) { 
            $query->where('language_code', App::getLocale())->get();}])->get();
        // return $countries;
        return view('countries.index',[
            'countries' => $countries
        ]);
    }

    public function getById($id) {
        $languages = Language::with(['translation' => function($query) use ($id){
            $query->where('id', $id)->get();
        }])->get();

        return view('countries.modals.edit', [
            'id' => $id,
            'languages' => $languages
        ]);
    }

    public function create() {
        $languages = Language::all();
        return view('countries.modals.create', [
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
        $country = new Country();
        $country->name = $nextVal;
        $country->save();
        return redirect()->route('countries');
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

        return redirect()->route('countries'); 
    }

    public function destroy($id) {
        Country::destroy($id);
        return redirect()->back();
    }




}
