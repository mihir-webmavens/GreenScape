@extends('frontend.layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Your Shopping Cart</h2>
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Cart Items</h4>
                </div>
                <div class="card-body">
                    <div class="cart-item d-flex justify-content-between align-items-center mb-3">
                        <div class="item-info d-flex align-items-center">
                            <img src="path/to/image.jpg" alt="Product Image" class="img-fluid" style="width: 100px;">
                            <div class="ml-3">
                                <h5>Product Name</h5>
                                <p class="mb-0">Quantity: 1</p>
                                <p class="mb-0">Price: $10.00</p>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-danger btn-sm">Remove</button>
                        </div>
                    </div>
                    <!-- Repeat for more items -->
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Order Summary</h4>
                </div>
                <div class="card-body">
                    <p>Subtotal: $10.00</p>
                    <p>Tax: $1.00</p>
                    <p><strong>Total: $11.00</strong></p>
                    <button class="btn btn-success btn-block">Proceed to Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
