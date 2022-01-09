<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use App\Models\Status;
use App\Models\Reason;
use App\Models\Language;
use App\Models\Translate;

class ReasonController extends Controller
{
    public function all() {
        $reasons = reason::with([
            'translation' => function($query) { 
            $query->where('language_id', App::getLocale())->get();}])->get();
        // return $reasons;
        return view('reasons.index',[
            'reasons' => $reasons
        ]);
    }

    public function getById($id) {
        $languages = Language::with(['translation' => function($query) use ($id){
            $query->where('key', $id)->get();
        }])->get();

        $reason = reason::where('reason_key', $id)->first();
        return view('reasons.modals.edit', [
            'id' => $id,
            'languages' => $languages,
            'reason' => $reason
        ]);
    }

    public function create() {
        $languages = Language::all();
        return view('reasons.modals.create', [
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
            'reason_key' => $uuid,
            'value' => $request->reason_value
        ];
        Reason::create($data);

        return redirect()->route('reasons');
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
        reason::where('reason_key', $id)->update([
            'code' => $request->code
        ]);
        
        return redirect()->route('reasons'); 
    }

    public function destroy($id, Request $request) {
        reason::where('reason_key', $id)->delete();
        Translate::where('key', $id)->delete();
        return redirect()->back();
    }
}
