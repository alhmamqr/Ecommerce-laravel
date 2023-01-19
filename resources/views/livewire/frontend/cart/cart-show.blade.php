<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
    
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Quantity</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Total</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>


                        @forelse ($carts as $cartItem)
                            @if ($cartItem->product)
                            <div class="cart-item">
                                <div class="row">
                                    <div class="col-md-4 my-auto">
                                        <a href="{{url('collection/'.$cartItem->product->category->slug.'/'.$cartItem->product->slug)}}">
                                            <label class="product-name">
                                                <img src="{{asset($cartItem->product->productImages[0]->image)}}" style="width: 50px; height: 50px" alt="">
                                              {{$cartItem->product->name}}
                                              @if ($cartItem->productColor)
                                                @if ($cartItem->productColor->color)
                                                <br>
                                                <span>Color:{{$cartItem->productColor->color->color}}</span>
                                                    
                                                @endif
                                              @endif
                                            </label>
                                        </a>
                                    </div>
                                    <div class="col-md-2 my-auto">
                                        <label class="price">{{$cartItem->product->selling_price}}</label>
                                    </div>
                                    <div class="col-md-2 col-7 my-auto">
                                        <div class="quantity">
                                            <div class="input-group">
                                                <button type="button" wire:loading.attr='disabled' wire:click='decrementQuantity({{$cartItem->id}})' class="btn btn1"><i class="fa fa-minus"></i></button>
                                                <input type="text" value="{{$cartItem->quantity}}" class="input-quantity" />
                                                <button type="button" wire:click='inecrementQuantity({{$cartItem->id}})' wire:loading.attr='disabled' class="btn btn1"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1 my-auto">
                                        <label for="" class="price">$ {{$cartItem->quantity * $cartItem->product->selling_price}}</label>
                                        @php
                                            $totalPrices +=$cartItem->quantity * $cartItem->product->selling_price
                                        @endphp
                                    </div>
                                    <div class="col-md-2 col-5 my-auto">
                                        <div class="remove">
                                            
                                            <button type="button" wire:click='removeCartitem({{$cartItem->id}})' class="btn btn-danger btn-sm">
                                                <span wire:loading.remove wire:target='removeCartitem({{$cartItem->id}})'>
                                                    <i class="fa fa-trash"></i> Remove
                                                    
                                                </span>
                                                <span wire:loading wire:target='removeCartitem({{$cartItem->id}})'>
                                                    <i class="fa fa-trash"></i> Removeing..

                                                </span>

                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                                
                            @endif
                        @empty
                            <h4>no cart found</h4>
                        @endforelse
                                
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-md-8 my-md-auto  mt-3">
                    <h4>
                        get the best deals & Offers <a href="{{url('/categories')}}">shop now</a>
                    </h4>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="shadow-sm bg-white p-3">
                        <h4>Total :
                            <span class="float-end">${{$totalPrices  }}</span>
                        </h4>
                        <hr>
                        <a href="{{url('/checkout')}}" class="btn btn-warning w-100">checkout</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
