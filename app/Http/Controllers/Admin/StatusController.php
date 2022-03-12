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

        $status = Status::where('status_key', $id)->first();
        return view('statuses.modals.edit', [
            'id' => $id,
            'languages' => $languages,
            'status' => $status
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
                'language_id' => $request->language_id[$key],
                'description' => $request->description[$key]
            ];
            Translate::create($data);
        }

        $data_store = [
            'status_key' => $uuid,
            'point_min' => $request->point_min,
            'point_max' => $request->point_max
        ];
        Status::create($data_store);

        return redirect()->route('statuses');
    }

    public function update(Request $request, $id) {
        foreach($request->value as $key => $value){
            $list[] = [
                'key' => $id,
                'value' => $value,
                'language_id' => $key,
                'description' => $request->description[$key]
            ];
        }
        Translate::upsert($list, ['key', 'language_id'], ['value', 'description']);
        Status::where('status_key', $id)->update([
            'point_min' => $request->point_min,
            'point_max' => $request->point_max
        ]);
        
        return redirect()->route('statuses'); 
    }

    public function destroy($id, Request $request) {
        Status::where('status_key', $id)->delete();
        Translate::where('key', $id)->delete();
        return redirect()->back();
    }
}
