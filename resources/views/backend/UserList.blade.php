@extends('backend.layouts.app')

@section('content')
@include('backend.layouts.breadcrumb')
@livewire('user-management')
@endsection

@push('scripts')
<script>
    let table = new DataTable('#myTable', {
    responsive: true
});
</script>
@endpush
