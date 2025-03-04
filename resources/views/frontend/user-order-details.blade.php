@extends('frontend.layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center py-4">
            <h2 class="mb-0">Order Details</h2>
        </div>
        <div class="card-body">
            <div class="order-info">
                <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
                <p><strong>Status:</strong>
                    <span class="text-dark  badge badge-pill bg-{{ $order->status == 'Completed' ? 'primary' : 'warning' }} ">
                        {{ $order->status }}
                    </span>
                </p>
            </div>

            <hr>

            <div class="order-items">
                <h4 class="text-primary">Items Ordered</h4>
                <ul class="list-group">
                    @php
                        $quantity;
                        $Total = null;
                    @endphp

                    @foreach($products as $key => $product)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">{{ $product->name }}</h5>
                                <small>Quantity: <strong>{{ $quantity[$key] }}</strong></small>
                                <p class="mb-0">Price: <strong>${{ number_format($product->price, 2) }}</strong></p>
                            </div>
                            <img src="{{ asset('storage/' . $product->image) }}" class="rounded-circle" width="60" height="60" alt="{{ $product->name }}">
                        </li>
                        @php
                            $Total += $quantity[$key] * $product->price;
                        @endphp
                    @endforeach
                </ul>
            </div>

            <hr>

            <div class="order-total text-center">
                <h3 class="text-success">Total Amount</h3>
                <p class="display-4 font-weight-bold">${{ number_format($Total, 2) }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
