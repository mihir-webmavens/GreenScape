<div>
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">
            {{ session('message') }}
            </div>
        @endif

        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h4 class="card-title">Order List</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="myTable" class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Order Id</th>
                    <th>Customer</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Created_At</th>
                    <th>Updated_At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->user->name}}</td>
                            <td>{{$order->address->address}}</td>
                            <td>{{$order->address->phone}}</td>
                            <td>{{$order->address->email}}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->updated_at }}</td>
                            <td>
                                <select class="form-control" width="300px" wire:model="orderStatus" wire:change="updateOrderStatus({{ $order->id }}, $event.target.value)">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </td></td>
                        </tr>
                        @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
</div>
