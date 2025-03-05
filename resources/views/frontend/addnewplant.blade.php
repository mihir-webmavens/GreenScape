@extends('frontend.layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h2 class="mb-0 text-white">Add New Plant</h2>
            </div>
            <div class="card-body">
                <form action="{{route('InsertNewPlant')}}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="image" class="form-label">Plant image:</label>
                        <input type="file" class="form-control" id="image" name="image" value="{{old('image')}}" placeholder="Plant Name">
                        @error('image')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Plant Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Plant Name">
                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="watering" class="form-label">Watering Interval:</label>
                        <input type="number" class="form-control" id="watering" name="watering"  value="{{old('watering')}}"  placeholder="(X) Time">
                        @error('watering')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="sunlight" class="form-label">Sunlight Interval:</label>
                        <input type="number" class="form-control" id="sunlight"  value="{{old('sunlight')}}"  name="sunlight" placeholder="(X) Time">
                        @error('sunlight')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="fertilizing" class="form-label">Fertilizing Interval:</label>
                        <input type="number" class="form-control" id="fertilizing"  value="{{old('fertilizing')}}"  name="fertilizing" placeholder="(X) Time ">
                        @error('fertilizing')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    </div>
                    <button type="submit" class="btn btn-success w-100">Add Plant</button>
                </form>
            </div>
        </div>
    </div>
@endsection