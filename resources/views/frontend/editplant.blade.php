@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center m-4">Plant Updates</h2>
        <div class="row d-flex">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $plant->image) }}" style="object-fit: cover;  height:100%" alt="Plant Image" class="img-fluid">
            </div>
            <!-- FullCalendar -->
            <div class="mt-5 w-50" id="calendar"></div>
        </div>

    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.js"></script>
    @endpush
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#calendar').fullCalendar({
                    events: [
                    @foreach ($events as $event )
                        
                    {
                        id: "{{$event->id}}",
                        title: "{{$event->title}}",
                        start: "{{$event->start}}",
                        end: "{{$event->end}}",
                        color: "{{$event->color}}",
                    },
                    
                    @endforeach

                    ],
                    eventClick: function(event) {
                        let newStatus = event.color === 'red' ? 'completed' : 'upcoming';

                        $.ajax({
                            url: `/calendar/update-status/${event.id}`,
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                status: newStatus
                            },
                            success: function(response) {
                                location.reload();
                            }
                        });
                    }
                });
            });
        </script>
    @endpush

    </body>

    </html>
@endsection
