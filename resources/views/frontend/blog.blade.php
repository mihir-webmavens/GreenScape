@extends('frontend.layouts.app')


@section('content')
    <div class="container mt-5">
        <h2 class="text-center "> <span class="border-bottom"> Our Blogs</span></h2>
        <div class="row">
            @foreach ($blogs as $blog)
                <div class="col-md-12 mb-5 p-4 shadow-sm rounded bg-white">
                    <h1 class="fw-bold text-primary">{{ $blog->title }}</h1>
                    @if (!empty($blog->image))
                        <div class="text-center my-4">
                            <img src="{{ asset('storage/' . $blog->image) }}" class="img-fluid rounded shadow my-4"
                                style="max-width: 100%; height: auto; max-height: 500px; object-fit: cover;"
                                alt="{{ $blog->title }}">
                        </div>
                    @endif

                    <p class="text-dark fs-5">{!! $blog->content !!}</p>
                    <p class="text-secondary small fst-italic">🕒 Created: {{ $blog->created_at->format('M d, Y') }}</p>
                    <p class="text-secondary small fst-italic">⌚ Last Updated: {{ $blog->updated_at->format('M d, Y') }}</p>
                </div>
               
            @endforeach
        </div>
    </div>
@endsection
