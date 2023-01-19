<div>
   




   <div class="py-3 py-md-5 bg-light">
      <div class="container"> 
          <div class="row">
              
              <div class="col-md-5 mt-3">
                  <div class="bg-white border" wire:ignore>
                      {{-- <img src="{{asset($product->productImages[0]->image)}}" class="w-100" alt="Img"> --}}

                      <div class="exzoom" id="exzoom">
                        <!-- Images -->
                        <div class="exzoom_img_box">
                          <ul class='exzoom_img_ul'>
                            @foreach ($product->productImages as $itemImages)
                                
                            <li><img src="{{asset($itemImages->image)}}"/></li> 
                            @endforeach
                            ...
                          </ul>
                        </div>
                        <!-- <a href="https://www.jqueryscript.net/tags.php?/Thumbnail/">Thumbnail</a> Nav-->
                        <div class="exzoom_nav"></div>
                        <!-- Nav Buttons -->
                        <p class="exzoom_btn">
                            <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                            <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                        </p>
                      </div>
                      
                  </div>
              </div>
              <div class="col-md-7 mt-3">
                  <div class="product-view">
                      <h4 class="product-name">
                          {{$product->name}}
                           
                      </h4>
                      <hr>
                      <p class="product-path">
                          Home /  {{$product->category->name}} /  {{$product->name}}  
                           
                      </p>
                      <div>
                          <span class="selling-price">$ {{$product->selling_price}}</span>
                          <span class="original-price">$ {{$product->original_price}}</span>
                      </div>
                      @if ($product->productColors->count() >0)
                      @if ($product->productColors)
                          @foreach ($product->productColors as $itemColor)
                              {{-- <input type="radio" name="colorSelection" value="{{$itemColor->id}}">{{$itemColor->color->color}} --}}
                              <label for="" class="colorSelectionLable" style="background-color:{{$itemColor->color->code}};padding:10px;color:white "
                                wire:click="colorSelected({{$itemColor->id}})" >
                                {{$itemColor->color->color}}
                            </label>
                          @endforeach
                      @endif
                          @if ($this->ProductColorSelectedQuantity =='outOfStock')
                              
                          <label class="btn-sm py-1 p-1 mt-2 text-white bg-danger">Out Stock</label>
                          @elseif ($this->ProductColorSelectedQuantity >0)
                          <label class="btn-sm py-1 mt-2 p-1 text-white bg-success">In Stock</label>
                              
                          @endif



                      @else
                            @if ($product->quantity)
                            <label class="btn-sm py-1 mt-2 text-white bg-success">In Stock</label>
                            
                            @else
                            <label class="btn-sm py-1 mt-2 text-white bg-danger">Out Stock</label>
                                
                            @endif
                      @endif
                      <div class="mt-2">
                          <div class="input-group">
                              <span class="btn btn1" wire:click='decrementQuantity'><i class="fa fa-minus"></i></span>
                              <input type="text" value="{{$this->quantityCount}}" wire:model='quantityCount' readonly class="input-quantity" />
                              <span class="btn btn1" wire:click='incrementQuantity'><i class="fa fa-plus"></i></span>
                          </div>
                      </div>
                      <div class="mt-2">
                          <button type="button" wire:click="AddToCartProduct({{$product->id}})" class="btn btn1"> <i class="fa fa-shopping-cart"></i> Add To Cart</button>
                          <button type="button" wire:click='addtowishlist({{$product->id}})'  class="btn btn1">
                            <span wire:loading.remove wire:target='addtowishlist({{$product->id}})'>
                                <i class="fa fa-heart"></i> Add To Wishlist  
                            </span>
                            <span wire:loading wire:target='addtowishlist({{$product->id}})'>Adding..</span>
                        
                        
                        </button>
                      </div>
                      <div class="mt-3">
                          <h5 class="mb-0">Small Description</h5>
                          <p>
                              Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a ty
                          </p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12 mt-3">
                  <div class="card">
                      <div class="card-header bg-white">
                          <h4>Description</h4>
                      </div>
                      <div class="card-body">
                          <p>
                              Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                          </p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

 
</div>



@push('scripts')
    
<script>
    $(function(){

$("#exzoom").exzoom({

  // thumbnail nav options
  "navWidth": 60,
  "navHeight": 60,
  "navItemNum": 5,
  "navItemMargin": 7,
  "navBorder": 1,

  // autoplay
  "autoPlay": false,

  // autoplay interval in milliseconds
  "autoPlayTimeout": 2000
  
});

});
</script>

@endpush