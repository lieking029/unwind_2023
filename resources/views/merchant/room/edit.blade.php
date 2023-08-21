@extends('layouts.app')

@section('content')
    <div class="container-fluid card">
        <div class="card-header row">
            <div class="col">
                <h4>ROOMS</h4>
            </div>
            <div class="col">
            </div>
        </div>
        <form action="{{ route('room.update', $data['resort']->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body rooms-container">
                @foreach ($data['resort']->rooms as $resort)
                    <div class="row appended-row mt-3">
                        <div class="p-3 row">
                            <div class="col">
                                <h5>ROOM {{ $loop->index + 1 }} </h5>
                            </div>
                            <div class="col">
                                <a href="{{ route('room.destroy', $resort->id) }}" class="btn btn-danger"
                                    style="float: right"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Image of the Room</label>
                            <input type="file" name="rooms[{{ $loop->index }}][room_image]" class="form-control">
                        </div>
                        <div class="col mt-3">
                            <div class="form-group">
                                <label for="">Max Guest(s) Count</label>
                                <div class="input-group">
                                    <input type="text" name="rooms[{{ $loop->index }}][max_guest_count]"
                                        value="{{ $resort->max_guest_count }}" class="form-control"
                                        placeholder="Max Guest Count">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Bath Count</label>
                                <div class="input-group">
                                    <input type="text" name="rooms[{{ $loop->index }}][bath_count]"
                                        value="{{ $resort->bath_count }}" class="form-control" placeholder="Bath Count">
                                </div>
                            </div>
                        </div>
                        <div class="col mt-3">
                            <div class="form-group">
                                <label for="">Bed Count</label>
                                <div class="input-group">
                                    <input type="text" name="rooms[{{ $loop->index }}][bed_count]"
                                        value="{{ $resort->bed_count }}" class="form-control" placeholder="Bed Count">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Room Price</label>
                                <div class="input-group">
                                    <input type="text" name="rooms[{{ $loop->index }}][price]"
                                        value="{{ $resort->price }}" class="form-control" placeholder="Price">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="">
                <button type="button" class="btn btn-primary my-4" id="addRoom" style="float: left">Add
                    Rooms</button>
                <button type="submit" class="btn btn-success my-4" style="float: right">Save</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script type="module">
        $(() => {

            $('#addRoom').on('click', function() {

                const roomLength = $('.rooms-container .appended-row').length
                console.log(roomLength);
                const room = `
        <div class="row appended-row mt-3">
            <div class="p-3">
                <h5>ROOM</h5>
            </div>
            <div class="form-group">
                <label for="">Image of the Room</label>
                <input type="file" name="rooms[${roomLength}][room_image]" class="form-control">
            </div>
            <div class="col mt-3">
                <div class="form-group">
                    <label for="">Max Guest(s) Count</label>
                    <div class="input-group">
                        <input type="text" name="rooms[${roomLength}][max_guest_count]" class="form-control" placeholder="Max Guest Count">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Bath Count</label>
                    <div class="input-group">
                        <input type="text" name="rooms[${roomLength}][bath_count]" class="form-control" placeholder="Bath Count">
                    </div>
                </div>
            </div>
            <div class="col mt-3">
                <div class="form-group">
                    <label for="">Bed Count</label>
                    <div class="input-group">
                        <input type="text" name="rooms[${roomLength}][bed_count]" class="form-control" placeholder="Bed Count">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Room Price</label>
                    <div class="input-group">
                        <input type="text" name="rooms[${roomLength}][price]" class="form-control" placeholder="Price">
                    </div>
                </div>
            </div>
        </div>
            `;

                // Appending the new room to a container (modify this line if you have a different container in your HTML)
                $('.rooms-container').append(room);

                if ($('.rooms-container .appended-row').length > 0) {
                    $('#save').removeAttr('hidden');
                }
            });

        });
    </script>
@endpush
