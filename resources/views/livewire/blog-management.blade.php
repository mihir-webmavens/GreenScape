<div>
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title">Blog List</h4>
                <div wire:click="addBlog" class="btn btn-primary btn-round">Add Blog</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>BlogId</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Image</th>
                                <th>Created_At</th>
                                <th>Updated_At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $blog)
                                <tr>
                                    <td>{{ $blog->id }}</td>
                                    <td>
                                        <div
                                            style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                            {{ $blog->title }}</div>
                                    </td>
                                    <td>
                                        <div
                                            style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                            {!! Str::limit($blog->content, 100) !!}
                                        </div>
                                    </td>
                                    <td><img style="height: 50px"
                                            src="{{ $blog->image != null ? asset('storage/' . $blog->image) : asset('storage/Blogs/noImage.png') }}"
                                            alt="Error..."></td>
                                    <td>{{ $blog->created_at }}</td>
                                    <td>{{ $blog->updated_at }}</td>
                                    <td>
                                        <button class="btn btn-sm my-1 btn-primary"
                                            wire:click="editBlog({{ $blog->id }})">Edit</button>
                                        <button class="btn btn-sm my-1 btn-danger" wire:confirm="Are you sure?"
                                            wire:click="RemoveBlog({{ $blog->id }})">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    @if ($showModal)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5)">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Blog</h5>
                        <button type="button" class="close" wire:click="closeModal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="updateOrCreate">
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control" wire:model="image">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" wire:model="title">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Content</label>
                                <textarea type="text" id="Content" class="form-control" name="content" wire:model="content" rows="12"></textarea>
                                @error('content')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success">Update User</button>
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@script
    <script>
        Livewire.hook('morphed', ({
            el,
            component
        }) => {
            tinymce.remove();
            tinymce.init({
                selector: 'textarea#Content',
                plugins: [
                    'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link',
                    'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',          
                    'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed',
                    'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable',
                    'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments',
                    'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography',
                    'inlinecss', 'markdown', 'importword', 'exportword', 'exportpdf'
                ],
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                tinycomments_mode: 'embedded',
                tinycomments_author: 'Author name',
                mergetags_list: [{
                        value: 'First.Name',
                        title: 'First Name'
                    },
                    {
                        value: 'Email',
                        title: 'Email'
                    },
                ],
                ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
                    'See docs to implement AI Assistant')),
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
                setup: function(editor) {
                    editor.on('change', function() {
                        @this.set('content', editor.getContent());
                    });
                }
            });
            console.log("hiii")
        })
    </script>
@endscript
