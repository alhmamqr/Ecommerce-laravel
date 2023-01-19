
<div>


  @include('livewire.admin.brand.modal-form')

    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Brands
                        <a href="{{route('categories.create')}}" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#addBrandModal">Add Brand</a>
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
                                <th>slug</th>
                                <th>catagory</th>
                                <th>status</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody> 
                           @forelse ($brands as $brand)
                               <tr>
                                    <td>{{$brand->id}}</td>
                                    <td>{{$brand->name}}</td>
                                    <td>{{$brand->slug}}</td>
                                    @if ($brand->category)
                                    <td>{{$brand->category->name}}</td>
                                    @else
                                    <td>no</td>
                                    @endif
                                    <td>{{$brand->status =='0'?'heddin':'visible'}}</td>
                                    <td>
                                       
                                        <a wire:click='editBrand({{$brand->id}})'   class="btn btn-success" data-bs-toggle="modal" data-bs-target="#updateBrandModal">Edit</a>
                                        <a  wire:click='deleteBrand({{$brand->id}})'  class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteBrandModal">Delete</a>
                                    </td>
                               </tr>
                           @empty
                               <tr>
                                <td colspan="5">No brands now</td>
                               </tr>
                           @endforelse
                        </tbody>
                    </table>
                    <div>
                        {{$brands->links()}}
                    </div>
                    <div>
                        
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
            $('#addBrandModal').modal('hide');
            $('#updateBrandModal').modal('hide');
            $('#deleteBrandModal').modal('hide');
    });
    </script>
@endpush

