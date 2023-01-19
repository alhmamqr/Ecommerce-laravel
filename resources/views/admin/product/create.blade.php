@extends('layouts.admin')


@section('content')
 



<div>
 

    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Product
                        <a href="{{route('products')}}" class="btn btn-primary btn-sm float-end">Back</a>
                    </h3>
                    @if (session('message'))
                <h2 class="alert alert-success">{{session('message')}}</h2>
                    
                @endif
                </div>
                <div class="card-body"> 
                    <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                     
                     @csrf
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab-pane" aria-selected="false">Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo-tab-pane" type="button" role="tab" aria-controls="seo-tab-pane" aria-selected="false">Seo Tag</button>
                            </li> 
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="false">Image</button>
                            </li> 
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color-tab-pane" type="button" role="tab" aria-controls="color-tab-pane" aria-selected="false">Colors</button>
                            </li> 
                          </ul>
                          <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-6 p-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" >Name</span>
                                            <input type="text" name="name" class="form-control" placeholder="Name"  >
                                            @error('name')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                          </div>
                                    </div>
                                    <div class="col-md-6 p-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" >Slug</span>
                                            <input type="text" name="slug" class="form-control" placeholder="Slug"  >
                                            @error('slug')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                          </div>
                                    </div>
                                    <div class="col-md-6 p-3">
                                        <div class="input-group mb-3">
                                            <label class="m-3" for="">Select Category</label><br>
                                           <select name="category_id" id="" class="form-control">
                                            <option value="">...</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        
                                        </select> 
                                             

                                            @error('category_id')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                          </div>
                                    </div>
                                    <div class="col-md-6 p-3">
                                        <div class="input-group mb-3">
                                            <label for=""  class="m-3">Select Brands</label>
                                           <select name="brand" id="" class="form-control">
                                            <option value="">...</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
                                        
                                        </select> 
                                             

                                            @error('brand')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                          </div>
                                    </div>

                                    <div class="col-md-6 p-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" >Little Description</span>
                                            <textarea   name="small_description" class="form-control"    ></textarea>
                                            @error('small_description')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                          </div>
                                    </div>

                                    <div class="col-md-8 p-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" >Total Description</span>
                                            <textarea   name="description" class="form-control"  rows="5"  ></textarea>
                                            @error('description')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                          </div>
                                    </div>

                                </div>
                                
                            </div>
                            <div class="tab-pane fade" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
                                
                                <div class="row  ">
                                    <div class="col-md-6 p-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">$</span>
                                            <input type="number" name="original_price" class="form-control" aria-label="Amount (to the nearest dollar)">
                                            <span class="input-group-text">.00</span>
                                            @error('original_price')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                          </div>
                                    </div>
                                    <div class="col-md-6 p-3">
                                        <div class="input-group ">
                                            <span class="input-group-text">selling</span>
                                            <input type="number" name="selling_price" class="form-control" aria-label="Amount (to the nearest dollar)">
                                            <span class="input-group-text">.00</span>
                                            @error('selling_price')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                          </div>
                                    </div>

                                    <div class="col-md-6 p-3">
                                        <div class="input-group  ">
                                            <span class="input-group-text">quantity Number</span>
                                            <input type="number" name="quantity" class="form-control" aria-label="Amount (to the nearest dollar)">
                                            
                                            @error('quantity')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-7 m-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="status" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Visible</label>
                                            @error('status')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                          </div>
                                        
                                    </div>
                                    
                                    <div class="col-md-5 m-5">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="trending" type="checkbox" role="switch" id="flexSwitchCheckDefault1">
                                            <label class="form-check-label" for="flexSwitchCheckDefault1">trending</label>
                                            @error('trending')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                          </div>
                                        
                                    </div>

                                </div>

                            </div>
                            <div class="tab-pane fade" id="seo-tab-pane" role="tabpanel" aria-labelledby="seo-tab" tabindex="0">
                                <div class="row  ">
                                    <div class="col-md-6 p-3">
                                        <div class="input-group">
                                            <span class="input-group-text">meta_title</span>
                                            <textarea name="meta_title" class="form-control" rows="1" aria-label="With textarea"></textarea>
                                            @error('meta_title')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                          </div>
                                    </div>
                                    <div class="col-md-6 p-3">
                                        <div class="input-group">
                                            <span class="input-group-text">meta_keyword</span>
                                            <textarea name="meta_keyword" class="form-control" aria-label="With textarea"></textarea>
                                            @error('meta_keyword')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                          </div>
                                    </div>
                                    
                                    <div class="col-md-8 p-3">
                                        <div class="input-group">
                                            <span class="input-group-text">meta_description</span>
                                            <textarea name="meta_description" class="form-control" rows="5" aria-label="With textarea"></textarea>
                                            @error('meta_description')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                          </div>
                                    </div>

                                </div>
                            
                            </div> 
                            <div class="tab-pane fade" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                                
                                <div class="row">
                                    <div class="col-md-6 p-3">
                                        <div class="input-group mb-3">
                                            <input type="file" name="image[]" multiple class="form-control" id="inputGroupFile02">
                                            <label class="input-group-text"  for="inputGroupFile02">Upload</label>
                                            @error('image')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                          </div>
                                    </div>
                                </div>

                            </div> 


                            <div class="tab-pane fade" id="color-tab-pane" role="tabpanel" aria-labelledby="color-tab" tabindex="0">
                                
                                <div class="row">
                                    @forelse ($colors as $color)
                                        <div class="col-md-3 p-3">
                                            <div class="input-group mb-3">
                                                <label class="input-group-text"  for="{{$color->id}}">{{$color->color}}</label>
                                                <input type="checkbox" name="colors[{{$color->id}}]" value="{{$color->id}}" style="width: 20px;heigth:20px;margin:3px" id='{{$color->id}}'>
                                                <input type="number" name="color_quantity[{{$color->id}}]"  placeholder="quantity" class="form-control">
                                                
                                              </div>
                                            </div>
                                    
                                        @empty
                                        
                                        @endforelse
                                </div>

                            </div> 

                            <button type="submit" class="btn btn-primary">Add Product</button>
                          </div>


                        
                    </form>



                    
                </div>
            </div>
        </div>
      </div>     {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    </div>
     
</div>
 








@endsection







