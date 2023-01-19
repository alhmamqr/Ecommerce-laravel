<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistCount extends Component
{

    public $wishlistCount;
    protected $listeners = ['wishlistAddedUpdated'=>'wishlistCountCheck'];
    public function wishlistCountCheck(){
        if(Auth::check()){
        $this->wishlistCount = Wishlist::where('user_id',auth()->user()->id)->count();
        }else{
            $this->wishlistCount =0;
        }
    }
    public function render()
    {
        $this->wishlistCountCheck();
        return view('livewire.frontend.wishlist-count',[
            'wishlistCount'=>$this->wishlistCount
        ]);
    }
}
