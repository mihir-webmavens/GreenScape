@extends('backend.layouts.app');

@section('content')
    @livewire('plant-tracker')
@endsection
@push('scripts')
<script>
    let table = new DataTable('#myTable', {
    responsive: true
});
</script>
@endpush