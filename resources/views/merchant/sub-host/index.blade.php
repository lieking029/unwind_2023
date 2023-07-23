@extends('layouts.app')

@section('content')
    <div class="container-fluid card">
        <div class="card-header row">
            <div class="col">
                <h5>Sub-Host</h5>
            </div>
            <div class="col">
                <button class="btn btn-primary" style="float: right" data-bs-toggle="modal" data-bs-target="#subHostModal"><i
                        class="fas fa-plus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>
        <div class="modal fade" id="subHostModal" tabindex="-1" aria-labelledby="subHostModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="subHostModalLabel">Add Sub-Host</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('users.storeSubHost') }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            <div class="container-fluid row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Fullname</label>
                                        <div class="input-group">
                                            <input type="text" required name="fullname" value="{{ old('fullname') }}"
                                                placeholder="Fullname" class="form-control">
                                        </div>
                                    </div>
                                    @error('fullname')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="form-group mt-2">
                                        <label for="">Email Address</label>
                                        <div class="input-group">
                                            <input type="email" required name="email" value="{{ old('email') }}"
                                                placeholder="Email" class="form-control">
                                        </div>
                                    </div>
                                    @error('email')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="form-group mt-2">
                                        <label for="password">Password</label>
                                        <div class="input-group">
                                            <input type="password" required name="password" placeholder="Password"
                                                class="form-control">
                                        </div>
                                    </div>
                                    @error('password')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Phone Number</label>
                                        <div class="input-group">
                                            <input type="number" required name="phone_number"
                                                value="{{ old('phone_number') }}" placeholder="Phone Number"
                                                class="form-control">
                                        </div>
                                    </div>
                                    @error('phone_number')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="form-group mt-2">
                                        <label for="dob">Date Of Birth</label>
                                        <div class="input-group">
                                            <input type="date" name="dob" class="form-control"
                                                value="{{ old('dob') }}">
                                        </div>
                                    </div>
                                    @error('dob')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="form-group mt-2">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" placeholder="Confirm Password"
                                                id="password_confirmation" name="password_confirmation" required>
                                        </div>
                                    </div>
                                    @error('confirm_password')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script type="module">
    $(() => {

        const usersTable = window.LaravelDataTables['subhost_table'] = $('#subhost_table').DataTable();
        usersTable.on('draw.dt', function () {

        $('.editBtn').click(function() {
            fetch('/sub-host/' + $(this).data('user'))
            .then(response => response.json())
            .then(subHost => {
                console.log(subHost);
        })
        });
    });
});

    </script>
@endpush
