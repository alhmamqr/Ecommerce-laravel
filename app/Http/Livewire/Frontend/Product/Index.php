<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    public $products,$category,$brands,$brandInput=[],$priceInput;
    protected $queryString = [
        'brandInput' =>['except'=>'','as','brand'],
        'priceInput' =>['except'=>'','as','price'],
    ];
    public function mount( $category,$brands){
    $this->category =$category;
    $this->brands =$brands;
        
    }

    public function render()
    {
        $this->products =Product::where('category_id',$this->category->id)
        ->when($this->brandInput,function($q){
            $q->whereIn('brand',$this->brandInput);
        })
        ->when($this->priceInput,function($q){
            $q->when($this->priceInput == 'hight-to-low',function($q2){
                $q2->orderBy('selling_price','DESC');
            })
            ->when($this->priceInput,function($q2){
                $q2->orderBy('selling_price','ASC');
            });
        })
        ->where('status','1')->get();
        // return $this->products;
        return view('livewire.frontend.product.index',[
            'products'=>$this->products,
            'category'=>$this->category,
            'brand'=>$this->brands
        ]);
    }
}
