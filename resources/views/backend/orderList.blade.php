@extends('backend.layouts.app')

@section('content')
@livewire('order-list',['data'=>$orders])

@endsection

@push('scripts')
<script>
    let table = new DataTable('#myTable', {
    responsive: true
});
</script>
@endpush