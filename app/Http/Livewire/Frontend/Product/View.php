<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{



    public $product,$category,$productColor_id,$brands,$ProductColorSelectedQuantity ,$quantityCount=1;
    
    public function mount( $category,$brands,$product){
    $this->category =$category;
    $this->brands =$brands;
        
    }

    public function colorSelected($productColor_id){
        $this->productColor_id =$productColor_id;
        $productColor = $this->product->productColors()->where('id',$productColor_id)->first();
        $this->ProductColorSelectedQuantity = $productColor->quantity;
        if($this->ProductColorSelectedQuantity ==0){
            $this->ProductColorSelectedQuantity ='outOfStock';
        }    
    }
  

    public function addtowishlist($productID){
        if(Auth::check()){

            if(Wishlist::where('user_id',auth()->user()->id)->where('product_id',$productID)->exists()){
                session()->flash('message','Alrady added this');
                $this->dispatchBrowserEvent('message',[
                    'text'=>'Alrady added this',
                    'type'=>'warning',
                    'status'=>409
                ]);
                return false;

            }else{
                Wishlist::create([
                    'product_id'=>$productID,
                    'user_id'=>auth()->user()->id
                ]);
                $this->emit('wishlistAddedUpdated');
                session()->flash('message','success add to whislist');
                $this->dispatchBrowserEvent('message',[
                    'text'=>'success add to whislist',
                    'type'=>'success',
                    'status'=>200
                ]);
            }
        }else{
            session()->flash('message','please login to contenion');

            $this->dispatchBrowserEvent('message',[
                'text'=>'please login to contenion',
                'type'=>'info',
                'status'=>401
            ]);

            return false;
        }


    }


    public function decrementQuantity(){
        if($this->quantityCount > 1){
            $this->quantityCount--;
        }
    }
    public function incrementQuantity(){
        if($this->quantityCount <11){
            $this->quantityCount++;
        }
    }

    public function AddToCartProduct($productId){
        if(Auth::check()){
            if($this->product->where('id',$productId)->where('status','1')->exists()){
                if($this->product->productColors->count() >0){
                    if($this->ProductColorSelectedQuantity !==null){
                        if(!Cart::where('user_id',auth()->user()->id)->where('product_color_id',$this->productColor_id)->exists()){
                            $productColor =$this->product->productColors()->where('id',$this->productColor_id)->first();
                            if($productColor->quantity >0){
    
                                if($productColor->quantity > $this->quantityCount){
                                     Cart::create([
                                        'product_id' =>$this->product->id,
                                        'product_color_id'=>$productColor->id,
                                        'user_id'=>auth()->user()->id,
                                        'quantity'=>$this->quantityCount
                                     ]);
                                     $this->emit('CartAddedUpdated');
                                     $this->dispatchBrowserEvent('message',[
                                        'text'=>'success added to cart',
                                        'type'=>'success',
                                        'status'=>200
                                    ]); 
                                }else{
                                    $this->dispatchBrowserEvent('message',[
                                        'text'=>'just ' . $productColor->quantity. 'Avillabel',
                                        'type'=>'info',
                                        'status'=>404
                                    ]); 
                                }
    
    
    
                            }else{
                                $this->dispatchBrowserEvent('message',[
                                    'text'=>'out of stock',
                                    'type'=>'info',
                                    'status'=>404
                                ]); 
                            }
                            

                        }else{
                            $this->dispatchBrowserEvent('message',[
                                'text'=>'Alrady added this product ',
                                'type'=>'info',
                                'status'=>404
                            ]); 
                        }

                    } else{
                        $this->dispatchBrowserEvent('message',[
                            'text'=>'select to color product',
                            'type'=>'info',
                            'status'=>404
                        ]);
                    }
                }else{
                    if(!Cart::where('user_id',auth()->user()->id)->where('product_id',$this->product->id)->exists()){
                        if($this->product->quantity > 0){
                            if($this->product->quantity > $this->quantityCount){
                                Cart::create([
                                    'product_id' =>$this->product->id, 
                                    'user_id'=>auth()->user()->id,
                                    'quantity'=>$this->quantityCount
                                 ]);
                                 $this->emit('CartAddedUpdated');
                                 $this->dispatchBrowserEvent('message',[
                                    'text'=>'success added to cart',
                                    'type'=>'success',
                                    'status'=>200
                                ]); 
                            }else{
                                $this->dispatchBrowserEvent('message',[
                                    'text'=>'just ' . $this->product->quantity. 'Avillabel',
                                    'type'=>'info',
                                    'status'=>404
                                ]); 
                            }
                        }else{
                            $this->dispatchBrowserEvent('message',[
                                'text'=>'out of stock',
                                'type'=>'info',
                                'status'=>404
                            ]);  
                        }

                    }else{
                        $this->dispatchBrowserEvent('message',[
                            'text'=>'Alrady added this product ',
                            'type'=>'info',
                            'status'=>404
                        ]);
                    }

                }

            }else{
                $this->dispatchBrowserEvent('message',[
                    'text'=>'that product not found',
                    'type'=>'info',
                    'status'=>404
                ]); 
            }

        }else{
            $this->dispatchBrowserEvent('message',[
                'text'=>'please login to contenion',
                'type'=>'info',
                'status'=>401
            ]);
        }
    }

    public function render()
    {
        return view('livewire.frontend.product.view',[
            'products'=>$this->product,
            'category'=>$this->category,
            'brand'=>$this->brands
        ]);
    }
}
