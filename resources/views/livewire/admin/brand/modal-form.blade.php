{{-- add brand modal--}}
<div wire:ignore.self class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Brands</h1>
        <button type="button" class="btn-close"  wire:click='closeModel' data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form wire:submit.prevent='storeBrand'>
        <div class="modal-body">
          <div class="mb-3">
            <label for="">Brand Name</label>
            <input type="text"   wire:model.defer='name' class="form-control">
            @error('name')
                <small class="text-danger">{{$message}}</small>
            @enderror
          </div>
          <div class="mb-3">
            <label for="">Brand category</label>
            <select   wire:model.defer='category_id' class="form-control">
              <option value="">--selete</option>
              @foreach ($categories as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
              @endforeach
            </select>
            @error('category_id')
                <small class="text-danger">{{$message}}</small>
            @enderror
          </div>
          <div class="mb-3">
            <label for="">Brand Slug</label>
            <input type="text"  wire:model.defer='slug' class="form-control">
            @error('slug')
                <small class="text-danger">{{$message}}</small>
            @enderror
          </div>
          <div class="mb-3">
            <label for="">Brand Status</label> <br>
            <input type="checkbox"   wire:model.defer='status'  > checked : visible , unChecked :hidden 
            @error('status')
                <small class="text-danger">{{$message}}</small>
            @enderror
          </div>

        </div>
        <div class="modal-footer">
          <button type="button"  wire:click='closeModel' class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save </button>
        </div>
      </form>

    </div>
  </div>
</div>


{{-- update brand modal --}}
<div wire:ignore.self class="modal fade" id="updateBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Brands</h1>
        <button type="button" class="btn-close" wire:click='closeModel' data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="ml-3" wire:loading>
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div> Loading...
      </div>

      <div wire:loading.remove>
        <form wire:submit.prevent='updateBrand'>
          <div class="modal-body">
            <div class="mb-3">
              <label for="">Brand Name</label>
              <input type="text"   wire:model.defer='name' class="form-control">
              @error('name')
                  <small class="text-danger">{{$message}}</small>
              @enderror
            </div>
            <div class="mb-3">
              <label for="">Brand category</label>
              <select   wire:model.defer='category_id' class="form-control">
                <option value="">--selete</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}"  >{{$category->name}}</option>
                @endforeach
              </select>
              @error('category_id')
                  <small class="text-danger">{{$message}}</small>
              @enderror
            </div>
            <div class="mb-3">
              <label for="">Brand Slug</label>
              <input type="text"  wire:model.defer='slug' class="form-control">
              @error('slug')
                  <small class="text-danger">{{$message}}</small>
              @enderror
            </div>
            <div class="mb-3">
              <label for="">Brand Status</label> <br>
              <input type="checkbox"   wire:model.defer='status'  > checked : visible , unChecked :hidden 
              @error('status')
                  <small class="text-danger">{{$message}}</small>
              @enderror
            </div>
  
          </div>
          <div class="modal-footer">
            <button type="button"  wire:click='closeModel' class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save </button>
          </div>
        </form>

      </div>

    </div>
  </div>
</div>


{{-- delete brand modal --}}
<div wire:ignore.self class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Brands</h1>
        <button type="button" class="btn-close" wire:click='closeModel' data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="ml-3" wire:loading>
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div> Loading...
      </div>

      <div wire:loading.remove>
        <form wire:submit.prevent='destroyBrand'>
              <h5>Are you sure you want to be delte this brands</h5>
           
          <div class="modal-footer">
            <button type="button"  wire:click='closeModel' class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">delete </button>
          </div>
        </form>

      </div>

    </div>
  </div>
</div>