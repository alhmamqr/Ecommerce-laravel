<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        # code...
        $orders = Order::count();
        $products =Product::count();
        $categories =Category::count();
        $brands =Brand::count();
        $sliders =Slider::count();
        $users =User::count();
        $normalUser =User::where('role_as','0')->count();
        $AminUser =User::where('role_as','1')->count();
        return view('admin.dashboard',compact('orders','products','categories','brands','users','normalUser','AminUser'));
    }
}
