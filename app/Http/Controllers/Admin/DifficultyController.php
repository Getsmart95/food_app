<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Difficulty;

class DifficultyController extends Controller
{
    public function all() {
        $difficulties = Difficulty::all();

        return view('difficulties.index', [
            'difficulties' => $difficulties
        ]);
    }

    public function getById($id) {
        $difficulty = Difficulty::find($id);
        return view('difficulties.modals.edit', [
            'id' => $id,
            'difficulty' => $difficulty
        ]);
    }

    public function create() {
        return view('difficulties.modals.create');
    }

    public function store(Request $request) {
        Difficulty::create($request->all());

        return redirect()->route('difficulties');
    }

    public function update(Request $request, $id) {
        
        Difficulty::where('id', $id)->update([
            'difficulty' => $request->difficulty
        ]);
        
        return redirect()->route('difficulties'); 
    }

    public function destroy($id, Request $request) {
        
        Difficulty::destroy($id);

        return redirect()->route('difficulties');
    }
    
}
