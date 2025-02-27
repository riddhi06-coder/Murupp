<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use App\Models\Terms;


class PoliciesController extends Controller
{
    public function terms(Request $request)
    { 
        $term = Terms::first(); 
        $terms = Terms::all();
        return view('frontend.terms', compact('term','terms'));
    }
    
}