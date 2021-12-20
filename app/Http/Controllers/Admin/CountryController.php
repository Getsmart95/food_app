<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\FunctionController;
use App\Models\Country;
use App\Models\Language;
use App\Models\Translate;
use Illuminate\Support\Str;

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
            $query->where('language_id', App::getLocale())->get();}])->get();
        // return $countries;
        return view('countries.index',[
            'countries' => $countries
        ]);
    }

    public function getById($id) {
        $languages = Language::with(['translation' => function($query) use ($id){
            $query->where('key', $id)->get();
        }])->get();

        $country = Country::where('country_key', $id)->first();
        return view('countries.modals.edit', [
            'id' => $id,
            'languages' => $languages,
            'country' => $country
        ]);
    }

    public function create() {
        $languages = Language::all();
        return view('countries.modals.create', [
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
            'country_key' => $uuid,
            'code' => $request->code
        ];
        Country::create($data);

        return redirect()->route('countries');
    }

    public function update(Request $request, $id) {
        return $request;
        foreach($request->language_id as $key => $value){
            $list[] = [
                'key' => $id,
                'value' => $value,
                'language_id' => $key
            ];
        }
        // return $list;
        Translate::upsert($list, ['key', 'language_id'], ['value']);
        Country::where('country_key', $id)->update([
            'code' => $request->code
        ]);

        return redirect()->route('countries'); 
    }

    public function destroy($id, Request $request) {
        Country::where('country_key', $id)->delete();
        Translate::where('key', $id)->delete();
        return redirect()->back();
    }




}
