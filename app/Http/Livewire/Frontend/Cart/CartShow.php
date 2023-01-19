<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    public $carts,$totalPrices=0;



    public function decrementQuantity($cartItemId){
        $cartData= Cart::where('id',$cartItemId)->where('user_id',auth()->user()->id)->first();
        if($cartData){
            if($cartData->quantity == 0 ){
                $this->dispatchBrowserEvent('message',[
                    'text'=>'  canot decremont more than stupid',
                    'type'=>'error',
                    'status'=>400
                ]);
            }else{

                $cartData->decrement('quantity');
                $this->dispatchBrowserEvent('message',[
                    'text'=>'success decrement',
                    'type'=>'success',
                    'status'=>200
                ]);
            }
        }else{
            $this->dispatchBrowserEvent('message',[
                'text'=>'some thing waring',
                'type'=>'error',
                'status'=>404
            ]);
        }
    }
    public function inecrementQuantity($cartItemId){
        $cartData= Cart::where('id',$cartItemId)->where('user_id',auth()->user()->id)->first();
        if($cartData){
            if($cartData->productColor()->where('id',$cartData->product_color_id)->exists()){
                $productColor = $cartData->productColor()->where('id',$cartData->product_color_id)->first();
                if($productColor->quantity > $cartData->quantity){
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message',[
                        'text'=>'success increment',
                        'type'=>'success',
                        'status'=>200
                    ]);
                }else{
                    $this->dispatchBrowserEvent('message',[
                        'text'=>'Only ' .$productColor->quantity. ' avillable',
                        'type'=>'info',
                        'status'=>400
                    ]);
                } 

            }else{
                if($cartData->product->quantity > $cartData->quantity){
    
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message',[
                        'text'=>'success increment',
                        'type'=>'success',
                        'status'=>200
                    ]);
                }else{
                        $this->dispatchBrowserEvent('message',[
                            'text'=>'Only ' .$cartData->product->quantity. ' avillable',
                            'type'=>'info',
                            'status'=>400
                        ]);
                    }
  
            }
        }else{
            $this->dispatchBrowserEvent('message',[
                'text'=>'some thing waring',
                'type'=>'error',
                'status'=>404
            ]);
        }
    }



    public function removeCartitem($cartItem_id){

        $cartData = Cart::where('user_id',auth()->user()->id)->where('id',$cartItem_id)->first();
        if($cartData){
            $cartData->delete();
            $this->emit('CartAddedUpdated');
            $this->dispatchBrowserEvent('message',[
               'text'=>'success remove to cart',
               'type'=>'success',
               'status'=>200
           ]); 
        }else{
            $this->dispatchBrowserEvent('message',[
                'text'=>'sorry  dont remove to cart',
                'type'=>'error',
                'status'=>500
            ]);
        }
    }


    public function render()
    {
    
        $this->carts = Cart::where('user_id',auth()->user()->id)->get();
        // dd($this->carts);
        return view('livewire.frontend.cart.cart-show',[
            'carts'=>$this->carts
        ]);
    }
}
