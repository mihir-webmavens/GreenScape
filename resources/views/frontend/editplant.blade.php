@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center m-4">Plant Updates</h2>
    <div class="row">
        <div class="col-md-6">
        <img src="{{ asset('storage/'.$plant->image) }}" alt="Plant Image" class="img-fluid">
        </div>
        <div class="col-md-6">
        <h2>{{$plant->name}}</h2>
        <p>Next Date Sunlight : {{\Carbon\Carbon::parse($plant->next_sunlight)->format('d-M-Y') }}</p>
        <p>Next Date watering : {{\Carbon\Carbon::parse($plant->next_watering)->format('d-M-Y')}}</p>
        <p>Next Date Fertilizing : {{\Carbon\Carbon::parse($plant->next_fertilizing)->format('d-M-Y')}}</p>
        </div>
    </div>
    </div>
@endsection