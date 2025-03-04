@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-5">Your Orders</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Order ID</th>

                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>

                    <td>{{ $order->status }}</td>
                    <td>
                        <a href="{{ route('order.details', $order->id) }}" class="btn btn-primary">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
