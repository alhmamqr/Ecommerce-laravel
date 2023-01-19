@extends('layouts.admin')

@section('title','orders page')
    
@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3> My Orders 
                </h3>
            </div>
            <div class="card-body">
                <form action="" method="GET">

                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Filter By Date</label>
                            <input type="date" name="date" value="{{Request::get('date') ?? date('Y-m-d')}}" class="form-controlr">
                        </div>
                        <div class="col-md-3">
                            <label for="">Filter By status</label>
                            <select name="status" class="form-select" id="">
                                <option value="">select status</option>
                                <option value="in progress" {{Request::get('status')== 'in Progress' ?'selected':''}} >In progress</option>
                                <option value="completed" {{Request::get('status')== 'completed' ?'selected':''}} >Completed</option>
                                <option value="pending" {{Request::get('status')== 'pending' ?'selected':''}} >pending</option>
                                <option value="cancelled" {{Request::get('status')== 'cancelled' ?'selected':''}} >cancelled</option>
                                <option value="out-for-delivery" {{Request::get('status')== 'out-for-delivery' ?'selected':''}} >out-for-delivery</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <button type="submit" class="btn btn-primary">Fillter</button>
                        </div>
                    </div>
                </form>
                <hr>
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
                                            <a href="{{url('admin/orders/'.$order->id)}}" class="btn btn-primary btn-sm">view</a>
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
 
 

@endsection