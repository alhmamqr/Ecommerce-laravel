<div>

    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>Brands</h4>
                </div>
                <div class="card-body">
                    @foreach ($category->brands as $brandItem)
                        <label for="" class="d-block">
                            <input type="checkbox" wire:model="brandInput" value="{{$brandItem->id}}">{{$brandItem->name}}
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <h4>Price</h4>
                </div>
                <div class="card-body">
                     
                        <label for="price1" class="d-block">
                            <input id="price1" type="radio" name="price" wire:model="priceInput" value="low-to-hight"> low-to-hight
                        </label>
                        <label for="price2" class="d-block">
                            <input id="price2" type="radio" name="price" wire:model="priceInput" value="hight-to-low"> hight-to-low
                        </label>
                   
                </div>
            </div>
        </div>
    
<div class="col-md-9">
    <div class="row">
    @forelse ($products as $product)
    <div class="col-md-3">
        <div class="product-card">
            <div class="product-card-img">
                @if ($product->quantity > 0 )
                    
                <label class="stock bg-success">In Stock</label>
                @else
                <label class="stock bg-danger">Out Stock</label>
                
                @endif
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
                <div class="mt-2">
                    <a href="" class="btn btn1">Add To Cart</a>
                    <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                    <a href="" class="btn btn1"> View </a>
                </div>
            </div>
        </div>
    </div>
        
    @empty
        <div class="col-sm-12">
            <h4>No Product</h4>
        </div>
    @endforelse
</div> 
</div>
</div>




</div>
