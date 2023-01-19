@extends('layouts.app')

@section('title','Arraivais page')
    
@section('content')
    

<div class="py-5 ">
    <div class="container">
        <div class="row  ">
            <div class="col-md-12">
                <h4>New Arravials</h4>
                <div class="underline mb-4"></div>
            </div>
             @if($productTrending)
               
                 @foreach ($productTrending as $product)
                    <div class="col-md-4">
                        <div class="product-card ">
                            <div class="product-card-img arrivials">
                             
                                
                                
                                <label class="stock bg-danger">new</label>
                                
                               
                                <img src="{{asset($product->productImages[0]->image)}}" alt="Laptop">
                            </div>
                            <div class="product-card-body">
                                @foreach ($brands as $brand)
                                @if ($product->brand == $brand->id)
                                <p class="product-brand">{{$brand->name}}</p>
                                    
                                @endif
                                @endforeach
                                <h5 class="product-name">
                                   <a href="{{url('collection/'.$product->category->slug.'/'.$product->slug)}}">
                                        {{$product->name}}
                                   </a>
                                </h5>
                                <div>
                                    <span class="selling-price">${{$product->selling_price}}</span>
                                    <span class="original-price">${{$product->original_price}}</span>
                                </div> 
                            </div>
                        </div>

                    </div>
                
                     
                 
                 @endforeach
                
             @else
    
            <div class="col-sm-12">
                <h4>No Product</h4>
            </div>
                 
             @endif
                
            


            <div class="text-center">
                <a href="{{url('/categories')}}" class="btn btn-warning">view more</a>
            </div>
        </div>
    </div>
</div>




@endsection