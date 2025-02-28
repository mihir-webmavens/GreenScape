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
                @php $subtotal = 0 @endphp
                <div class="card-body">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                @php $subtotal += $item->product->price * $item->quantity @endphp
                                <tr>
                                    <td>
                                        <img src="{{asset($item->product->image)}}" alt="{{$item->product->name}}" class="img-fluid rounded" style="width: 100px; height: 100px; object-fit: cover;">
                                    </td>
                                    <td>{{$item->product->name}}</td>
                                    <td>
                                        <div class="input-group main_parent">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary btn-sm btn-minus" type="button">-</button>
                                            </div>
                                            <div class="btn-sm cart_items_quantity_{{$item->id}}">{{$item->quantity}}</div>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary btn-sm btn-plus"  type="button">+</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>&#8377;{{$item->product->price}}</td>
                                    <td data-cart_id="{{$item->id}}">
                                        <button class="btn btn-danger btn-sm remove-cart-item">Remove</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Order Summary</h4>
                </div>
                <div class="card-body">
                    <p>Subtotal: &#8377;<span id="subtotal">{{$subtotal}}</span></p>
                    <p>Flate Rate: &#8377;{{$flateRate = 20}}</p>
                    <p><strong>Total: &#8377; <span id="total"> {{$subtotal!= 0 ? $subtotal + $flateRate : 0}} </span></strong></p>
                    <button class="btn btn-success btn-block">Proceed to Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
   $(document).on("click", ".remove-cart-item", function () {

        cart_id = $(this).closest('td').data('cart_id')

        hideTr = $(this).closest('tr');


        let itemPrice = parseFloat(hideTr.find('td:nth-child(4)').text().replace('₹', '').trim());
        let itemQuantity = parseInt(hideTr.find('td:nth-child(3)').find('.cart_items_quantity_' + cart_id).text().trim());
        let totalPriceForItem = itemPrice * itemQuantity;
        console.log(totalPriceForItem);

        let currentSubtotal = parseFloat($('#subtotal').text());
        console.log(currentSubtotal);
        let newSubtotal = currentSubtotal - totalPriceForItem;  // Subtract the price of the removed item
        $('#subtotal').text(newSubtotal.toFixed(2));  // Update the subtotal in the DOM
        // $('#total').text(newSubtotal.toFixed(2));  // Update the subtotal in the DOM

        $.ajax({
            url: "{{route('cart.remove')}}",
            type: "POST",
            data: {
                _token: "{{csrf_token()}}",
                cart_id: cart_id
            },
            success: function (response) {
                if (response.message) {
                    hideTr.remove();
                    let flateRate = parseFloat("{{$flateRate}}") ;
                    let newTotal = newSubtotal + flateRate
                    if(newSubtotal == 0){
                        newTotal = 0;
                    }
                    $('#total').text(newTotal.toFixed(2)); // Update the total
                }
            }
        })

})

</script>
@endpush
