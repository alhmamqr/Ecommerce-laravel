@extends('layouts.app')

@section('title','Home page')
    
@section('content')
    
 
{{-- 

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">

    <div class="carousel-inner">
        @foreach ($sliders as $key=> $sliderItem)
            
        <div class="carousel-item {{$key ==0 ?'active':''}}">
            @if ($sliderItem->image)
            <img src="{{asset($sliderItem->image)}}{{asset($sliderItem->image)}}" class="d-block w-100" alt="...">
                
            @endif
            <div class="carousel-caption d-none d-md-block">
                <div class="custom-carousel-content">
                    <h1>
                        {!! $sliderItem->title !!}
                    </h1>
                    <p>
                        {!! $sliderItem->description !!}
                    </p>
                    <div>
                        <a href="#" class="btn btn-slider">
                            Get Now
                        </a>
                    </div>
                </div>
            </div>
        </div>  
        
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div --}}


{{-- 
<div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    @foreach ($sliders as $key=> $sliderItem)
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{asset($sliderItem->image)}}" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>First slide label</h5>
          <p>Some representative placeholder content for the first slide.</p>
        </div>
      </div>
      @endforeach

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>











<div> --}}


<div class="container">
    <div class="row">
       
            <div class="owl-carousel owl-theme slider">
                @foreach ($sliders as $key=> $sliderItem)
                <div class="col-md-12">
                    <div class="sliderItem">
                        <img src="{{asset($sliderItem->image)}}" alt="">
                    </div>

                </div>
                @endforeach
            </div>
        
    </div>
</div>








    <div class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h4>Welcom to Web page</h4>
                    <div class="underline mx-auto"></div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum, blanditiis velit laudantium minus eveniet dicta sint
                    quidem eligendi architecto a iure labore esse alias aut recusandae corporis magnam! Excepturi, impedit.
                    </p>
                </div>
            </div>
        </div>
    </div>

{{-- New Arravials --}}
    <div class="col-md-12 text-center">
        <h4>New Arravials</h4>
        <div class="underline mb-4 mx-auto"></div>
    </div>

    <div class="py-5 ">
        <div class="container">
            <div class="row  ">
                 @if($productTrending)
                 <div class="col-md-12">
                    <div class="owl-carousel owl-theme trendingProuduct">
                     @foreach ($productTrending as $product)
                        <div class="col-md-12">
                            <div class="product-card">
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
                    </div>
                 @else
        
                <div class="col-sm-12">
                    <h4>No Product</h4>
                </div>
                     
                 @endif
                    
                </div>
            </div>
        </div>
    </div>





{{-- New Arravials --}}
<div class="col-md-12 text-center">
    <h4>All Products</h4>
    <div class="underline mb-4 mx-auto"></div>
</div>

<div class="py-5 ">
    <div class="container">
        <div class="row  ">
             @if($allProducts)
             <div class="col-md-12">
                <div class="owl-carousel owl-theme allProducts">
                 @foreach ($allProducts as $product)
                    <div class="col-md-12">
                        <div class="product-card">
                            <div class="product-card-img arrivials">
                             
                                
                                
                                <label class="stock bg-danger">
                                    @if ($product->trending == '1')
                                        new
                                    @else
                                        in stock
                                    @endif
                                </label>
                                
                               
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
                </div>
             @else
    
            <div class="col-sm-12">
                <h4>No Product</h4>
            </div>
                 
             @endif
                
            </div>
        </div>
    </div>
</div>













</div>




@endsection



@section('script')
    
<script>

$('.trendingProuduct').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})
</script>
<script>

$('.allProducts').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})
</script>
{{-- <script>
 var owl = $('.slider');
owl.owlCarousel({
    items:4,
    loop:true,
    margin:10,
    autoplay:true,
    autoplayTimeout:1000,
    autoplayHoverPause:true
});
$('.play').on('click',function(){
    owl.trigger('play.owl.autoplay',[1000])
})
$('.stop').on('click',function(){
    owl.trigger('stop.owl.autoplay')
})
</script> --}}



<script>

var owl = $('.slider');
owl.owlCarousel({
    items:1,
    margin:10,
    autoHeight:true,
    autoplay:true,
    autoplayTimeout:3000,
    loop:true,
    autoplayHoverPause:true

});
</script>
@endsection







