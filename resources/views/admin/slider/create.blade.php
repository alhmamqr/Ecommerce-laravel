@extends('layouts.admin')


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3> Add slider
                    <a href="{{route('slider.index')}}" class="btn btn-primary text-white btn-sm float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{route('slider.store')}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                        <div class="col-md-6  mb-3">
                            <label for="name">title</label>
                            <input type="text" class="form-control" name="title" id="name" placeholder="Name">
                               @error('title')
                                <small class="alert alert-danger">{{$message}}</small>
                            @enderror  
                        </div> 
                        <div class="col-md-6  mb-3">
                            <label for="name">description</label>
                            <input type="text" class="form-control" name="description" id="name" placeholder="Name">
                               @error('description')
                                <small class="alert alert-danger">{{$message}}</small>
                            @enderror  
                        </div> 
                        <div class="col-md-6 mb-3">
                            <label for="image">image</label> 
                            <input type="file" class="form-control" name="image" id="image"  >
                            @error('image')
                                <small class="alert alert-danger">{{$message}}</small>
                            @enderror

                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status">status</label>
                            <input type="checkbox"   name="status" id="status" >
                        </div>   
                        <div class="col-md-3 mb-3"><button type="submit" class="btn btn-primary"> Add slider </button> </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div> 
@endsection







