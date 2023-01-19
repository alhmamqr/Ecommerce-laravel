@extends('layouts.app')

@section('title','thankyou page')
    
@section('content')
    
<div class="py-3 py-md-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="p-4 shadow bg-white">

                    <h2>Your logo</h2>
                    <h4>Thank you for shopping</h4>
                    <a href="{{url('/categories')}}" class="btn btn-primary">shop now</a>
                </div>
            </div>
        </div>
    </div>
 </div>
 

@endsection