<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

use App\Models\ProductDetails;
use App\Models\Carts;


class RegistrationController extends Controller
{

    public function register(Request $request)
    {
        return view('frontend.register');
    }
}