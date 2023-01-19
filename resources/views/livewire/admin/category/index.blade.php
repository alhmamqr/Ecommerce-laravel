
<div>


    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      </div>

    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Category
                        <a href="{{route('categories.create')}}" class="btn btn-primary btn-sm float-end">Add Category</a>
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
                                <th>Name</th>
                                <th>status</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->status =='0'?'hidden':'visible'}}</td>
                                    <td>
                                        <a href="{{route('categories.edit',$category->id)}}" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#updateModal">Edit</a>
                                        <a href="" wire:click='deleteCategory({{$category->id}})'  class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</a>
                                    </td>
                                </tr>                            
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{$categories->links()}}
                    </div>
                </div>
            </div>
        </div>
      </div>     {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    </div>
     
</div>

@push('script')
    <script>
        window.addEventListener('close-model',event=>{
            $('#deleteModal').modal('hide');
    });
    </script>
@endpush

