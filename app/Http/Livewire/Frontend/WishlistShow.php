<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistShow extends Component
{




    public function removewishlist($itemId){

        Wishlist::where('user_id',auth()->user()->id)->where('id',$itemId)->delete();
         $this->emit('wishlistAddedUpdated');
        $this->dispatchBrowserEvent('message',[
            'text'=>'whislist success removed',
            'type'=>'success',
            'status'=>200
        ]);
    }



    public function render()
    {
         
       
        $wishlist = Wishlist::where('user_id',auth()->user()->id)->get();
       
        return view('livewire.frontend.wishlist-show',[
            'wishlist'=>$wishlist
        ]);
    }
}
