@extends('backend.layouts.app')

@section('content')
@livewire('order-list',['data'=>$orders])

@endsection
