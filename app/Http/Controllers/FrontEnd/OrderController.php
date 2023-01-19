<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //

    public function index()
    {
        $orders = Order::where('user_id',auth()->user()->id)->orderBy('created_at','desc')->paginate(10);
        return view('forntend.orders.index',compact('orders'));
    }

    public function view($orderId)
    {
        $order = Order::where('user_id',auth()->user()->id)->where('id',$orderId)->first();
        if($order){
            // return $order;
            return view('forntend.orders.view',compact('order'));

        }
        return redirect()->back()->with('message','somting worng');
    }
}
