@extends('frontend.layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center mb-6">Community Posts</h1>
    <div id="posts" class="space-y-6">
        @foreach($posts as $post)
            <div class="bg-white shadow-md p-6 rounded-lg">
                <h2 class="text-2xl font-semibold">{{ $post->title }}</h2>
                <p class="text-gray-700 mt-2">{{ $post->content }}</p>
                <small class="text-gray-500">Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}</small>
                
                <!-- Comment Section -->
                <div class="mt-4 border-t pt-4">
                    <h3 class="text-xl font-semibold">Comments</h3>
                    <div class="space-y-4">
                        @foreach($post->comments as $comment)
                            
                            <div class="bg-gray-100 p-3 rounded-md">
                                <p class="text-gray-800">{{ $comment->content }}</p>
                                <small class="text-gray-500">- {{ $comment->user->name }}, {{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Add Comment Form -->
                    {{-- @auth
                    <form action="{{ route('comment.store', $post->id) }}" method="POST" class="mt-4">
                        @csrf
                        <textarea name="content" rows="3" class="w-full border rounded-lg p-3" placeholder="Write a comment..."></textarea>
                        <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">Post Comment</button>
                    </form>
                    @else
                    <p class="text-gray-500 mt-2">Please <a href="{{ route('login') }}" class="text-blue-500">login</a> to comment.</p>
                    @endauth --}}
                </div>
            </div>
            <hr>
        @endforeach
    </div>
</div>
@endsection