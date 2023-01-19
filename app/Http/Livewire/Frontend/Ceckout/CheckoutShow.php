<?php

namespace App\Http\Livewire\Frontend\Ceckout;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderitem;
use Livewire\Component;
use Illuminate\Support\Str;
class CheckoutShow extends Component
{
    public $carts,$totalProductAmount;

    public $fullname,$email,$phone,$pincode,$address ,$payment_mode=null,$payment_id=null;



    public function rules(){
        return [
            'fullname'=>'required|string|max:121',
            'email'=>'required',
            'phone'=>'required',
            'pincode'=>'required',
            'address'=>'required|string|max:500'
        ];
    }


public function codOrder(){
$this->payment_mode ='Cash on Delivery';
$codeOrder = $this->placeOrder();

// $order = Order::create([
//     'user_id'=>auth()->user()->id,
//     'tracking_no'=>'alhmam'.Str::random(10),
//     'fullname'=>$this->fullname,
//     'pincode'=>$this->pincode,
//     'address'=>$this->address,
//     'status_message'=>'in progress',
//     'payment_mode'=>$this->payment_mode,
//     'payment_id'=>$this->payment_id,
    
// ]);
// $this->validate();
// $order = new Order;
// $order->user_id =auth()->user()->id;
// $order->tracking_no='alhmam' . Str::random(10);
// $order->fullname=$this->fullname;
// $order->address =$this->address;
// $order->pincode = $this->pincode;
// $order->status_message= 'in progress' ;
// $order->payment_mode=$this->payment_mode  ;
// $order->payment_id =$this->payment_id ;
// $order->email =$this->email  ;
// $order->phone = $this->phone ;
  
// $order->save();



//     foreach($this->carts as $cart){
//     $orderItems = Orderitem::create([
//         'order_id'=>$order->id,
//         'product_id'=>$cart->product_id,
//         'product_color_id'=>$cart->product_color_id,  
//         'quantity'=>$cart->quantity,
//         'price'=>$cart->product->selling_price
//     ]);  
//  }



if($codeOrder){
    Cart::where('user_id',auth()->user()->id)->delete();
    $this->dispatchBrowserEvent('message',[
        'text'=>'success order placed',
        'type'=>'success',
        'status'=>200
    ]);
    return redirect()->to('/thankyou');
}else
{
    $this->dispatchBrowserEvent('message',[
        'text'=>'something wiring',
        'type'=>'error',
        'status'=>404
    ]);
}
}

public function placeOrder(){
    $this->validate();
    $order = Order::create([
        'user_id'=>auth()->user()->id,
        'tracking_no'=>'alhmam'.Str::random(10),
        'fullname'=>$this->fullname,
        'pincode'=>$this->pincode,
        'address'=>$this->address,
        'status_message'=>'in progress',
        'payment_mode'=>$this->payment_mode,
        'payment_id'=>$this->payment_id,
        
        'email'=>$this->email,
        'phone'=>$this->phone, 
    ]);
        foreach($this->carts as $cart){
        $orderItems = Orderitem::create([
            'order_id'=>$order->id,
            'product_id'=>$cart->product_id,
            'product_color_id'=>$cart->product_color_id,  
            'quantity'=>$cart->quantity,
            'price'=>$cart->product->selling_price
        ]);  
        if($cart->product_color_id != null){
            $cart->productColor()->where('id',$cart->product_color_id)->decrement('quantity',$cart->quantity);
        }else{
            $cart->product()->where('id',$cart->product_id)->decrement('quantity',$cart->quantity);

        }
     }

     return $order;
}


    public function totalProductAmount(){
        $this->totalProductAmount=0;
        $this->carts= Cart::where('user_id',auth()->user()->id)->get();
        foreach($this->carts as $cart){
            $this->totalProductAmount += $cart->product->selling_price * $cart->quantity;
        }
        return $this->totalProductAmount;
    }
    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email  = auth()->user()->email;
        // dd($this->email);
        $this->totalProductAmount =$this->totalProductAmount();
        return view('livewire.frontend.ceckout.checkout-show',[
            'totalProductAmount'=>$this->totalProductAmount,
        ]);
    }
}
