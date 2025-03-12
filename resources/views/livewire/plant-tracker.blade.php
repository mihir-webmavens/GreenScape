<div>
    <div>
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="card-title">Plant List</h4>
                    <div wire:click="addPlant" class="btn btn-primary btn-round">Add Plants</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>image</th>
                                    <th>Name</th>
                                    <th>Created_At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plants as $plant)
                                    <tr>
                                        <td><img src="{{ asset('storage/' . $plant->image) }}" alt=""
                                                class="img-fluid rounded-circle"
                                                style="max-width: 50px; max-height: 50px; object-fit: cover"></td>
                                        <td>{{ $plant->name }}</td>
                                        <td>{{ $plant->created_at }}</td>
                                        <td>
                                            <button class="btn btn-sm my-1 btn-primary"
                                                wire:click="editPlant({{ $plant->id }})">Edit</button>
                                            <button class="btn btn-sm my-1 btn-danger"
                                                wire:click="removePlant({{ $plant->id }})">Delete</button>
                                            <button class="btn btn-sm my-1 btn-warning"
                                                wire:click="addEvent({{ $plant->id }})">Add Event</button>
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
                            <h5 class="modal-title">Edit Plant</h5>
                            <button type="button" class="close" wire:click="closeModal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="addOrUpdatePlant">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" wire:model="image">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" wire:model="name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                               

                                <button type="submit" class="btn btn-success">Add/Update</button>
                                <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($eventList)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5)">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Plant</h5>
                        <button type="button" class="close" wire:click="closeModal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-2 align-items-center" wire:submit.prevent="addOrUpdateEvent">
                            <div class="col-auto">
                                <label>Title</label>
                                <input type="text" class="form-control" wire:model="title">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-auto">
                                <label> Start Date</label>
                                <input type="date" class="form-control" wire:model="start">
                                @error('start')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-auto">
                                <label>End Date</label>
                                <input type="date" class="form-control" wire:model="end">
                                @error('end')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-auto">
                                <label>Color</label>
                               <select class="form-control" wire:model="color" >
                                <option value="null" selected disabled >--Selectr--</option>
                                <option value="green" selected >Green</option>
                                <option value="blue">Blue</option>
                                <option value="red">red</option>
                                <option value="orange">orange</option>
                                <option value="yellow">yellow</option>
                                <option value="purple">purple</option>
                               </select>
                                @error('color')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-sm btn-primary" type="submit">Add</button>
                                <button class="btn btn-sm btn-warning" type="reset">reset</button>
                            </div>

                        </form>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 200px;">Event Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Color</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td>{{$event->title}}</td>
                                        <td>{{$event->start}}</td>
                                        <td>{{$event->end}}</td>
                                        <td>{{$event->color}}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" wire:click="removeEvent({{$event->id}})">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

</div>
