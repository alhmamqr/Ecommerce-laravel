<?php

namespace App\Http\Controllers\ForntEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //
    public function index(){
        return view('forntend.checkout.index');
    }
}
