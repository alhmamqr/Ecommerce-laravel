@extends('layouts.app')

@section('title','orders page')
    
@section('content')
    
<div class="py-3 py-md-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="p-4 shadow bg-white">
                    
                    <div class="table-respomsive">
                        <table class="table table-bordered tabel-striped">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Tracking No</th>
                                    <th>UserName</th>
                                    <th>Payment Mode</th>
                                    <th>Order Date</th>
                                    <th>Status Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->tracking_no}}</td>
                                        <td>{{$order->fullname}}</td>
                                        <td>{{$order->payment_mode}}</td>
                                        <td>{{$order->created_at}}</td>
                                        <td>{{$order->status_message}}</td>
                                        <td>
                                            <a href="{{url('/order/'.$order->id)}}" class="btn btn-primary btn-sm">view</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7">no orders</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{$orders->links()}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
 </div>
 

@endsection