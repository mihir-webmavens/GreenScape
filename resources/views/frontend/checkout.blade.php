@extends('frontend.layouts.app');

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Checkout</h2>
        <div class="row">
            <div class="col-md-8">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (@isset($address))
                    <div class="card"></div>

                        <div class="card-body">
                            <p><strong>Name:</strong> {{$address->name}}</p>
                            <p><strong>Email:</strong> {{$address->email}}</p>
                            <p><strong>Phone:</strong> {{$address->phone}}</p>
                            <p><strong>Address:</strong> {{$address->address}}</p>
                            <p><strong>City:</strong> {{$address->city}}</p>
                            <p><strong>State:</strong> {{$address->state}}</p>
                            <p><strong>Zip:</strong> {{$address->zip}}</p>
                            <p><strong>Country:</strong> {{$address->country}}</p>
                        </div>
                    </div>
                    <form action="{{route('checkoutProcessWithAddress')}}" method="POST">
                        @csrf
                        <input type="hidden" name="address_id" value="{{$address->id}}">
                        <button type="submit" class="btn btn-primary btn-block mt-3">Use this Address</button>
                    </form>
                @else

                <form action="{{route('checkoutProcess')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">                  </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}">
                    </div>
                    <div class="form-group">
                        <label for="address">Shipping Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}">
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}">                  </div>
                    <div class="form-group">
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="state" name="state" value="{{old('state')}}">                    </div>
                    <div class="form-group">
                        <label for="zip">Zip Code</label>
                        <input type="text" class="form-control" id="zip" name="zip" value="{{old('zip')}}">                  </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" id="country" name="country" value="{{old('country')}}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Place Order</button>
                </form>
                @endif

            </div>
            <div class="col-md-4">
                <h4>Order Summary</h4>
                <ul class="list-group mb-3">
                    @php $total = 0; @endphp
                    @foreach ($items as $item )
                    <li class="list-group-item d-flex justify-content-between">
                        <span>{{$item->product->name}}</span>
                        <strong>&#8377;{{$item->product->price * $item->quantity}}</strong>
                        @php $total += $item->product->price * $item->quantity; @endphp
                    </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (IND)</span>
                        <strong>&#8377; {{$total}}</strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
