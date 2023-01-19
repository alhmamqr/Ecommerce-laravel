@extends('layouts.app')

@section('title','thankyou page')
    
@section('content')
    
<div class="py-3 py-md-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="p-4 shadow bg-white">
                    <h4 class="text-primary">
                        <i class="fa fa-shopping-cart text-dark">My Order Details</i>
                        <a href="{{url('/orders')}}" class="btn btn-danger btn-sm float-end">Back</a>
                    </h4>

                    <hr>


                    <div class="row">
                        <div class="col-md-6">
                            <h5>Order Details</h5>
                            <hr>
                            <h6>Order Id: {{$order->id}} </h6>
                            <h6>Traking Id/No:{{$order->tracking_no}} </h6>
                            <h6>Order Craeted Date: {{$order->created_at}}</h6>
                            <h6>paymant Mode: {{$order->payment_mode}}</h6>
                            <h6 class="border p-2 text-success">
                                Order Status Message : <span class="text-uppercase">
                                    in progress
                                </span>
                            </h6> 
                        </div>
                        <div class="col-md-6">
                            <h5>User Details</h5>
                            <hr>
                            <h6>Full Name: {{$order->fullname}}</h6>
                            <h6>Email ID: {{$order->email}} </h6>
                            <h6>phone: {{$order->phone}}</h6>
                            <h6>Address: {{$order->address}}</h6>
                            <h6>pin code: {{$order->pincode}}</h6 >
                        </div>
                        <hr>
                        <h5>Order items</h5>
                        <hr>


                        <div class="table-respomsive">
                        <table class="table table-bordered tabel-striped">
                            <thead>
                                <tr>
                                 
                                    <th>Item Id</th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @forelse ($order->orderItems as $orderItem)
                                    <tr>
                                         <td width='10%'>{{$orderItem->id}}</td>
                                         <td width='10%'>

                                            <img src="{{asset($orderItem->product->productImages[0]->image)}}" style="width: 50px; height: 50px" alt="">
                                         
                                         </td>
                                         <td>
                                            {{$orderItem->product->name}}
                                            @if ($orderItem->productColor)
                                              @if ($orderItem->productColor->color)
                                              <br>
                                              <span>Color:{{$orderItem->productColor->color->color}}</span>
                                                  
                                              @endif
                                            @endif
                                         </td>
                                         <td width='10%'>{{$orderItem->price}}$</td>
                                         <td width='10%'>{{$orderItem->quantity}}</td>
                                         <td width='10%' class="fw-bold">{{$orderItem->quantity * $orderItem->price}}$</td>
                                         @php
                                         $totalPrice += $orderItem->quantity * $orderItem->price;
                                        @endphp
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7">no orders</td>
                                    </tr>
                                @endforelse
                                <tr>
                                    <td colspan="5" class="fw-bold">Total Amount </td>
                                    <td colspan="1" class="fw-bold">{{$totalPrice}}$</td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>




                    </div>



                </div>
            </div>
        </div>
    </div>
 </div>
 

@endsection