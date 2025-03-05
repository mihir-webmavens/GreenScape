@extends('backend.layouts.app')

@section('content')
@include('backend.layouts.breadcrumb')
@livewire('admin-user-management')
@endsection

@push('scripts')
<script>
    let table = new DataTable('#myTable', {
    responsive: true
});<div>
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
</div>

</script>
@endpush
