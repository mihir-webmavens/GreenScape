<div>
    <!-- User Table -->
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">
            {{ session('message') }}
            </div>
        @endif

        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h4 class="card-title">User List</h4>
            <div wire:click="addProduct" class="btn btn-primary btn-round">Add Product</div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="myTable" class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Name</th>
                    <th>Sku</th>
                    <th>Price</th>
                    <th>Brand</th>
                    <th>Description</th>
                    <th>Created_At</th>
                    <th>Updated_At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td><img src="{{ asset("storage/".$product->image) }}" alt="" class="img-fluid rounded-circle" style="max-width: 50px; max-height: 50px; object-fit: cover"></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->sku }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->brand }}</td>
                            <td>{{ $product->description}}</td>
                            <td>{{ $product->created_at }}</td>
                            <td>{{ $product->updated_at }}</td>
                            <td>
                                <button class="btn btn-sm my-1 btn-primary" wire:click="editProduct({{$product->id}})" >Edit</button>
                                <button class="btn btn-sm my-1 btn-danger" >Delete</button>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    @if ($showModal)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5)">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="close" wire:click="closeModal">&times;</button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateProduct">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" wire:model="image">
                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>sku</label>
                            <input type="text" class="form-control" wire:model="sku">
                            @error('sku') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" class="form-control" wire:model="price">
                            @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Brand</label>
                            <input type="text" class="form-control" wire:model="brand">
                            @error('brand') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" class="form-control" wire:model="description">
                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Update User</button>
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
