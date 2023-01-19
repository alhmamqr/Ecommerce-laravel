@extends('layouts.admin')


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3> Add color
                    <a href="{{route('colors')}}" class="btn btn-primary text-white btn-sm float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('colors.update',$color->id)}}"  >
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6  mb-3">
                            <label for="name">color</label>
                            <input type="text" class="form-control" name="color" value="{{$color->color}}" id="name" placeholder="Name">
                            @error('color')
                                <small class="alert alert-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="slug">code</label>
                            <input type="text" class="form-control" name="code" value="{{$color->slug}}" id="slug" placeholder="slug">
                            @error('code')
                                <small class="alert alert-danger">{{$message}}</small>
                            @enderror
                        </div>  
                        <div class="col-md-6 mb-3">
                            <label for="status">status</label>
                            <input type="checkbox"   name="status"  {{$color->status == '0'?'':'checked'}}   id="status" >
                             
                        </div>   
                        <div class="col-md-3 mb-3"><button type="submit" class="btn btn-primary"> Edit color </button> </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div> 
@endsection







