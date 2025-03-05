@extends('frontend.layouts.app')

@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f8f0;
        text-align: center;
        margin: 0;
        padding: 20px;
    }
    .container {
        max-width: 1200px;
        margin: 0 auto;
    }
    .title {
        font-size: 2em;
        color: #2d6a4f;
        margin-bottom: 20px;
    }
    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }
    .card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: scale(1.05);
    }
    .card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
    }
    .card h2 {
        margin-top: 10px;
        font-size: 1.2em;
        color: #2d6a4f;
    }
</style>

<div class="container">
    <h1 class="title">Beautiful Plants</h1>
    <div class="grid">
        @foreach ($plants as $plant)
        <div class="card">
            <a href="{{route('editPlant',$plant->id)}}">
                <img src="{{ asset('storage/'.$plant->image) }}" alt="{{$plant->name}}">
                <h2>{{$plant->name}}</h2>
                <p>Next Date Sunlight: {{ \Carbon\Carbon::parse($plant->next_sunlight)->format('d-M-Y') }}</p>
                <p>Next Date watering: {{ \Carbon\Carbon::parse($plant->next_watering)->format('d-M-Y') }}</p>
                <p>Next Date Fertilizing: {{ \Carbon\Carbon::parse($plant->next_fertilizing)->format('d-M-Y') }}</p>
            </a>
            <form method="POST" action="{{route('deletePlant',$plant->id)}}">
                @csrf
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>
        </div>
        @endforeach
      
        
      
        <div class="card d-flex justify-content-center">
            <a href="{{route('addnewplant')}}" class="rounded bg-light h-100 d-flex align-items-center justify-content-center flex-column ">
                <h1><i class="fas fa-seedling "></i></h1>
                <h2>Add Your Plant</h2>
                <i class="fas fa-plus-circle"></i>
            </a>
        </div>
    </div>
</div>
</body>
@endsection