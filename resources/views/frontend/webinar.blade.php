@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <h2 class="text-2xl text-center font-bold mb-4">Upcoming Webinars</h2>
<table class="min-w-full bg-white border border-gray-200">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b">Title</th>
            <th class="py-2 px-4 border-b">Discription</th>
            <th class="py-2 px-4 border-b">Date</th>
            <th class="py-2 px-4 border-b">Link</th>
        </tr>
    </thead>
    <tbody>
        @foreach($webinars as $webinar)
        <tr class="hover:bg-gray-100">
            <td class="py-2 px-4 border-b">{{ $webinar->title }}</td>
            <td class="py-2 px-4 border-b">{{ $webinar->description }}</td>
            <td class="py-2 px-4 border-b">{{ $webinar->date }}</td>
            <td class="py-2 px-4 border-b"><a href="{{ url("$webinar->link")}}" class="text-blue-500 hover:underline">Open</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection