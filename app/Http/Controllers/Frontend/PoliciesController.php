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
use App\Models\Shipping;
use App\Models\Returns;
use App\Models\Privacy;



class PoliciesController extends Controller
{
    public function terms(Request $request)
    { 
        $terms = Terms::all();
        return view('frontend.terms', compact('terms'));
    }

    public function shipping(Request $request)
    { 
        $terms = Shipping::all();
        return view('frontend.shipping', compact('terms'));
    }

    public function return(Request $request)
    { 
        $terms = Returns::all();
       
        return view('frontend.refund', compact('terms'));
    }
    
    public function privacy(Request $request)
    { 
        $terms = Privacy::all();
        // dd($terms);
        return view('frontend.privacy', compact('terms'));
    }
}