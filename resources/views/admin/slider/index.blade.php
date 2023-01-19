@extends('layouts.admin')


@section('content')
 



<div>

{{-- modal --}}
    {{-- <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Category Delete</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent='destroyCategory'>
            <div class="modal-body">
              <h6> Are you sure you want to delete that category</h6>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit"  class="btn btn-primary">Yes, Delete</button>
            </div>
        </form>

          </div>
        </div>
      </div> --}}

    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>slider
                        <a href="{{route('slider.create')}}" class="btn btn-primary btn-sm float-end">Add slider</a>
                    </h3>
                    @if (session('message'))
                <h2 class="alert alert-success">{{session('message')}}</h2>
                    
                @endif
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>title</th>
                                <th>description</th>
                                <th>image</th> 
                                <th>status</th> 
                                <th>Actions</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                          @forelse ($sliders as $slider)
                              <tr>
                                <td>{{$slider->id}}</td>
                                <td>{{$slider->title}}</td>
                                <td>{{$slider->description}}</td>
                                <td> 
                               <img src="{{asset($slider->image)}}" alt="{{$slider->image}}" width="25px" height="25px">
                                </td>
                                <td>{{$slider->status == '0'?'heddin' : 'visible'}}</td> 
                                <td>
                                  <a href="{{route('slider.edit',$slider->id)}}" class="btn btn-success">Edit</a>
                                  <a href="{{route('slider.delete',$slider->id)}}" onclick="return confirm('are You sure')" class="btn btn-danger">Delete</a>
                                </td>
                              </tr>
                          @empty
                              <tr>
                                <td colspan="5">
                                  no sliders
                                </td>
                              </tr>
                          @endforelse
                        </tbody>
                    </table>
                    <div>
                        {{-- {{$categories->links()}} --}}
                    </div>
                </div>
            </div>
        </div>
      </div>     {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    </div>
     
</div>

{{-- @push('script')
    <script>
        window.addEventListener('close-model',event=>{
            $('#deleteModal').modal('hide');
    });
    </script>
@endpush --}}









@endsection







