@extends('layouts.admin')

@section('title','order details page')
    
@section('content')
    
<div class="row">
    <div class="col-md-12">

        @if (session('message'))
            <small class="text-success">{{session('message')}}</small>
        @endif


        <div class="card">
            <div class="card-header">
                <h3> Order details
                    <a href="{{url('admin/orders')}}" class="btn btn-danger text-white m-1 btn-sm float-end">Back</a>
                    <a href="{{url('admin/invoice/'.$order->id.'/generate')}}" class="btn btn-primary m-1 text-white btn-sm float-end">
                    Download Invoice
                    
                    </a>
                    <a href="{{url('admin/invoice/'.$order->id)}}" target="_blank"  class="btn m-1 btn-warning text-white btn-sm float-end">
                    view Invoice
                    
                    </a>
                    <a href="{{url('admin/invoice/'.$order->id.'/sendemail')}}" target="_blank"  class="btn m-1 btn-warning text-white btn-sm float-end">
                    view Invoice
                    
                    </a>
                     
                </h3>
            </div>
            <div class="card-body">
            <div class="p-4 shadow bg-white">
                

                    <div class="row">
                        <div class="col-md-6">
                            <h5>Order Details</h5>
                            <hr>
                            <h6>Order Id: {{$order->id}} </h6>
                            <h6>Traking Id/No:{{$order->tracking_no}} </h6>
                            <h6>Order Craeted Date: {{$order->created_at->format('d-m-Y h:i A')}}</h6>
                            <h6>paymant Mode: {{$order->payment_mode}}</h6>
                            <h6 class="border p-2 text-success">
                                Order Status Message : <span class="text-uppercase">
                                    {{$order->status_message}}
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

        <div class="card border mt-3">
            <div class="card-body">
                <h4>Order Procecss  (Order status Updates) </h4>


                <div class="row">
                    <div class="col-md-5">
                        <form method="POST" action="{{url('admin/orders/'.$order->id)}}">
                        @csrf
                        @method('PUT')
                        <label for="">Update Your Order Stauts</label>
                             <div class="inout-group">
                                <select name="order_status" id="" class="form-control">
                                    <option value="">select status</option>
                                    <option value="in progress" {{Request::get('status')== 'in Progress' ?'selected':''}} >In progress</option>
                                    <option value="completed" {{Request::get('status')== 'completed' ?'selected':''}} >Completed</option>
                                    <option value="pending" {{Request::get('status')== 'pending' ?'selected':''}} >pending</option>
                                    <option value="cancelled" {{Request::get('status')== 'cancelled' ?'selected':''}} >cancelled</option>
                                    <option value="out-for-delivery" {{Request::get('status')== 'out-for-delivery' ?'selected':''}} >out-for-delivery</option>
                                </select>
                                <button type="submit" class="btn btn-primary text-white">Update</button>
                             </div>
                        </form>

                    </div>
                    <div class="col-md-7">
                        <br>
                        <h4 class="mt-3">Currrent Order Status : <span class="text-upperxase">{{$order->status_message}}</span></h4>
                    </div>
                </div>



            </div>
        </div>


    </div>
 </div>
 

@endsection