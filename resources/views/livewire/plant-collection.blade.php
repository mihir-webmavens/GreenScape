<div>
    <style>
        .card-img-top {
            height: 350px;
            object-fit: cover;
        }

        .card-body {
            padding: 1rem;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .btn-lg {
            padding: 12px 25px;
            font-size: 1.25rem;
        }

        /* Hover effects for cards */
        .card:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease-in-out;
        }

        /* Hover effects for buttons */
      
    </style>


    <div class="container py-5">
        <!-- Title Section -->
        <h1 class="text-center text-primary mb-5">Beautiful Plants</h1>

        @if(session('delete'))
        <div class="alert alert-danger">{{session('delete')}}</div>
        @endif

        <!-- Button Section -->
        <div class="d-flex justify-content-center mb-5">
            <div wire:click="addPlant" class="btn btn-success btn-lg shadow-lg">
                <i class="bi bi-plus-circle"></i> Add New Plant
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($collections as $plant)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 rounded">
                        <button class="btn btn-danger mb-4 btn-sm position-absolute" style="top: 10px; right: 10px;" wire:click="deletePlant({{ $plant->id }})">
                            Delete
                        </button>
                        <a href="{{ route('editPlant', $plant->plant->id) }}" class="text-decoration-none">
                            <!-- Card Image -->
                            <img src="{{ asset('storage/' . $plant->plant->image) }}" class="card-img-top rounded-top"
                                alt="{{ $plant->name }}">

                            <!-- Card Body -->
                            <div class="card-body">
                                <h5 class="card-title text-center text-dark">{{ $plant->plant->name }}</h5>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    @if ($showModel)
        <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5)">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add plant in your gallery</h5>
                        <button type="button" class="btn close" wire:click="closeModal">&times;</button>
                    </div>
                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                        @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                        @endif
                        <div class="d-grid gap-2" style="grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));">
                            @foreach ($plants as $plant)
                                <div class="plant-item text-center">
                                    <img src="{{ asset('storage/' . $plant->image) }}" class="rounded"
                                        style="width: 200px;height:230px; object-fit: cover;;" alt="">
                                    <h4>{{ $plant->name ?? 'Plant Name' }}</h4>
                                    <button class="btn btn-sm btn-primary"
                                        wire:click="addToGallery({{ $plant->id ?? 0 }})">
                                        Add to Gallery
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
