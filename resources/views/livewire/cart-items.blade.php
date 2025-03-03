<div>
    <div class="container mt-5">
        <h2 class="text-center">Shopping Cart</h2>
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example row, you should loop through your cart items here -->
                            @php $subTotal = 0; @endphp
                            @foreach ($items as $item)
                            <tr>
                                <td>{{$item->product->name}}</td>
                                <td>
                                    <input type="number" min="1" class="form-control" value="{{$item->quantity}}" wire:change="updateQuantity({{$item->id}}, $event.target.value)">
                                </td>
                                <td>{{$item->product->price}}</td>
                                <td>{{ number_format($item->product->price * $item->quantity, 2) }}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm" wire:click="removeItem({{$item->id}})">Remove</button>
                                </td>
                            </tr>
                            @php $subTotal += $item->product->price * $item->quantity; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
                <div class="card">
                    <div class="card-header">
                        <h4>Cart Summary</h4>
                    </div>
                    <div class="card-body">
                        <p>SubTotal: {{number_format($subTotal,2)}}</p>
                        <p>Tax: $1.00</p>
                        <p>Total: $11.00</p>
                        <button class="btn btn-primary btn-block">Proceed to Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
