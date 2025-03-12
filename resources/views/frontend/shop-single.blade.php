@extends('frontend.layouts.app')

@section('content')

      <!-- Open Content -->
    <section class="bg-light py-5">
      @if(session('message'))
        <div class="alert alert-success">
        {{ session('message') }}
        </div>
      @endif
    
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="{{asset('storage/'.$product->image)}}" alt="Card image cap" id="product-detail">
                    </div>

                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2">{{$product->name}}</h1>
                            <p class="h3 py-2">₹{{$product->price}}</p>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Brand:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong>{{$product->brand}}</strong></p>
                                </li>
                            </ul>

                            <h6>Description:</h6>
                            <p>{{$product->description}}</p>
                            <form action="{{route('addToCart')}}" method="Post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <div class="row">

                                    <div class="col-auto">
                                        <ul class="list-inline pb-3">
                                            <li class="list-inline-item text-right pb-2">
                                                Quantity
                                                <input type="hidden" name="quantity" id="product-quanity" value="1">
                                            </li><br>
                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-minus">-</span></li>
                                            <li class="list-inline-item"><span class="btn bg-secondary text-white" id="var-value">1</span></li>
                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-plus">+</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    <div class="col d-grid">
                                        <button type="submit" class="btn btn-success btn-lg" name="submit" value="addtocard">Add To Cart</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Close Content -->



@endsection
