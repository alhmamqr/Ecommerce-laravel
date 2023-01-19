<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceOrderMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    //
    public function index(Request $request){
        $todayDate =  Carbon::now()->format('Y-m-d');
        $orders = Order::when($request->date != null,function($q) use ($request){
                        $q->whereDate('created_at',$request->date);
                         },function($q) use ($todayDate){
                            $q->whereDate('created_at',$todayDate);
                        })
                         ->when($request->status != null,function($q) use ($request){
                            $q->where('status_message',$request->status);
                        })
                        ->paginate(10);
        return view('admin.orders.index',compact('orders'));
    }




    public function show($orderId){
        $order = Order::where('id',$orderId)->first();
        if($order){
            return view('admin.orders.view',compact('order'));

        }else{
        return redirect('admin/orders')->with('message','sorry not found that order details');
        }
        
    }



    public function updateOrderStatus($orderId,Request $request){
        // return $request;
        $order = Order::where('id',$orderId)->first();
        if($order){
            $order->update([
                'status_message'=>$request->order_status
                ]);
                // return $order;
            return redirect('admin/orders/'.$order->id)->with('message','successUpdate status');

        }else{
        return redirect('admin/orders/'.$order->id)->with('message','sorry not found that order details');
        }
    }


    public function viewInvoice($orderId){
        $order = Order::findOrFail($orderId);
        return view('admin.invoice.generate-invoice',compact('order'));
    } 
    public function  generateInvoice($orderId){


    $order = Order::findOrFail($orderId);
    $data = [
        'order' =>$order
    ];
    $todayDate =Carbon::now()->format('d-m-Y');
    $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);
    return $pdf->download('invoice'.$order->id.'-'.$todayDate.'.pdf');

    }
    public function  sendEmail($orderId){


    $order = Order::findOrFail($orderId); 

        Mail::to("$order->email")->send(new InvoiceOrderMail($order));
        return 'ok'; 


    }


}
