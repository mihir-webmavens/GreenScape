@extends('backend.layouts.app')
@section('content')
@livewireStyles
@livewireScripts
@livewire('blog-management')

@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/slxfu2vqtz8sfuoblbhvewhuho1qzd8xiguiknl6zwhp0em4/tinymce/7/tinymce.min.js"
referrerpolicy="origin"></script>


<script>
    tinymce.init({
        selector: 'textarea#Content',
        plugins: 'code table lists',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
    });
</script>

@endpush
