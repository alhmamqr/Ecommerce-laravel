@extends('layouts.app')

@section('title')
{{$product->meta_title}}
@endsection

@section('meta_description')

{{$product->meta_description}}
@endsection

@section('meta_keyword')

{{$product->meta_keyword}}
@endsection 

 



@section('content')
    
    
 

<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">Our Products</h4>
            </div>

           
        <livewire:frontend.product.view :product="$product" :category="$category" :brands="$brands" />

        </div>
    </div>
</div>











@endsection