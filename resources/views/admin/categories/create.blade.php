@extends('layouts.admin')


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3> Add Category
                    <a href="{{route('categories')}}" class="btn btn-primary text-white btn-sm float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{url('admin/categories')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6  mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                               @error('name')
                                <small class="alert alert-danger">{{$message}}</small>
                            @enderror  
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="slug">slug</label>
                            <input type="text" class="form-control" name="slug" id="slug" placeholder="slug">
                                @error('slug')
                                <small class="alert alert-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="description">description</label>
                            <textarea class="form-control" name="description"  rows="3"> </textarea>
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
                        <h3>SEO TAG</h3>
                        <div class="col-md-12 mb-3">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="meta_title">
                                @error('meta_title')
                                <small class="alert alert-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="meta_keyword">Meta Keyword</label>
                            <textarea type="text" class="form-control" name="meta_keyword" id="meta_keyword"  rows="3"></textarea>
                                @error('meta_keyword')
                                <small class="alert alert-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="meta_description">Meta Description</label>
                            <textarea type="text" class="form-control" name="meta_description" id="meta_description"  rows="3"></textarea>
                                @error('meta_description')
                                <small class="alert alert-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3"><button type="submit" class="btn btn-primary"> Add Category </button> </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div> 
@endsection







