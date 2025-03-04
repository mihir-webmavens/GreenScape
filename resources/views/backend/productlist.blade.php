@extends('backend.layouts.app');

@section('content')

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
                    @foreach ($products as $product)
                    <tr>
                        <td><img src="{{ asset($product->profile) }}" alt="" class="img-fluid rounded-circle" style="max-width: 50px; max-height: 50px;"></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->age }}</td>
                        <td>{{ $product->email }}</td>
                        <td>{{ $product->phone }}</td>
                        <td>{{ $product->role }}</td>
                        <td>{{ $product->created_at }}</td>
                        <td>{{ $product->updated_at }}</td>

                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>

    <!-- Edit User Modal -->
 
</div>


@endsection
