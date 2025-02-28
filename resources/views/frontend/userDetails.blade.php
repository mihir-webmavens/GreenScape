@extends('frontend.layouts.app')

@section('content')
@session('status')
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endsession

@if($errors->any())
<div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach

</div>

@endif
<div class="container mt-5">
    <div class="row justify-content-start">
        <div class="col-md-6">
            <div class="card shadow-sm rounded-lg">
                <div class="card-body">

                    <form action="{{route('upddate_profile')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group text-center">
                            @if(auth()->user()->profile)
                                <label for="profile">
                                    <img src="{{ asset(auth()->user()->profile) }}" alt="Profile Image" style="object-fit: cover" width="120" height="120" class="rounded-circle mb-3">
                                </label>
                            @else
                                <label for="profile">
                                    <img src="{{asset('img/users/default1.png')}}" alt="Profile Image" width="120" class="rounded-circle mb-3">
                                </label>
                            @endif
                            <input type="file" class="form-control-file" id="profile" name="profile">
                        </div>

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}">
                        </div>

                        <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="text" class="form-control" id="age" name="age" value="{{ auth()->user()->age }}">
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}">
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ auth()->user()->phone }}">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mt-4">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
    }
    .card-header {
        background-color: #007bff;
        color: white;
        font-weight: bold;
    }
    .form-control-file {
        padding: 10px;
        border-radius: 5px;
    }
    .form-control {
        border-radius: 5px;
    }
    .btn {
        border-radius: 25px;
        font-size: 16px;
    }
</style>

@endsection
