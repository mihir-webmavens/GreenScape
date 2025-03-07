@extends('backend.layouts.app');

@section('content')

@livewire('product-management')

@endsection

@push('scripts')
<script>
    let table = new DataTable('#myTable', {
    responsive: true
});
</script>
@endpush