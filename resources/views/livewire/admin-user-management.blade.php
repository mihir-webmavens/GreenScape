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
            <a wire:click="addUserForm" class="btn btn-primary btn-round">Add Customer</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="myTable" class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Role</th>
                    <th>Created_At</th>
                    <th>Updated_At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td><img src="{{ asset('storage/'.$user->profile) }}" alt="" class="img-fluid rounded-circle" style="max-width: 50px; max-height: 50px;"></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->age }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            <button class="btn btn-sm my-1 btn-primary" wire:click="editUser({{ $user->id }})">Edit</button>
                            <button class="btn btn-sm my-1 btn-danger" wire:click="RemoveUser({{ $user->id }})">Delete</button>
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
                <div class="modal-body" wire:poll.5000ms="$refresh">
                    <form wire:submit.prevent="updateUser">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" wire:model="email">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Age</label>
                            <input type="number" class="form-control" wire:model="age">
                            @error('age') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" wire:model="phone">
                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" wire:model="role">
                                <option value="" selected disabled>Select Role</option>
                                <option value="admin" {{$role == "admin" ? "selected" : " "}} selected >Admin</option>
                                <option value="user" {{$role == "user" ? "selected" : ""}}>User</option>
                            </select>
                            @error('role') <span class="text-danger">{{ $message }}</span> @enderror
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
