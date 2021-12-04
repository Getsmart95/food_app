<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Translate;

class FunctionController extends Controller
{
    public function getNextVal() {
        $nextVal = Translate::max('id');
        if( !empty($nextVal) ) { 
            return $nextVal + 1;
        } else {
            return 1;
        };
    }
}
