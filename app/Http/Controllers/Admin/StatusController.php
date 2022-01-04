<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use App\Models\Status;
use App\Models\Language;
use App\Models\Translate;

class StatusController extends Controller
{
    public function all() {
        $statuses = Status::with([
            'translation' => function($query) { 
            $query->where('language_id', App::getLocale())->get();}])->get();
        // return $statuses;
        return view('statuses.index',[
            'statuses' => $statuses
        ]);
    }

    public function getById($id) {
        $languages = Language::with(['translation' => function($query) use ($id){
            $query->where('key', $id)->get();
        }])->get();

        $Status = Status::where('Status_key', $id)->first();
        return view('statuses.modals.edit', [
            'id' => $id,
            'languages' => $languages,
            'Status' => $Status
        ]);
    }

    public function create() {
        $languages = Language::all();
        return view('statuses.modals.create', [
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
                'language_id' => $request->language_id[$key]
            ];
            Translate::create($data);
        }

        $data = [
            'status_key' => $uuid,
            'point_min' => $request->point_min,
            'point_max' => $request->point_max
        ];
        Status::create($data);

        return redirect()->route('statuses');
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
        Status::where('Status_key', $id)->update([
            'code' => $request->code
        ]);
        
        return redirect()->route('statuses'); 
    }

    public function destroy($id, Request $request) {
        Status::where('Status_key', $id)->delete();
        Translate::where('key', $id)->delete();
        return redirect()->back();
    }
}
