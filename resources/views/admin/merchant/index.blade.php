@extends('layouts.app')

@section('content')
    @include('flash::message')


    <div class="main py-4">
        <div class="card  border-0 shadow table-wrapper table-responsive">
            <div class="card-header row" style="padding-bottom: 5px">
                <div class="col">
                    <h5 class="h5">{{ __('Merchants') }}</h5>
                </div>
                <div class="col text-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal"><i
                            class="fas fa-plus"></i></button>
                </div>
            </div>

            <div class="card-body">
                {{ $dataTable->table() }}
            </div>

            <div
                class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
            </div>
        </div>

        {{-- CREATE MODAL --}}
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('merchant.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Fullname <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="fullname" value="{{ old('fullname') }}"
                                        placeholder="Fullname" class="form-control">
                                </div>
                            </div>
                            @error('fullname')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="">Email Address <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="email" placeholder="Email Address" class="form-control">
                                </div>
                            </div>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="">Phone Number <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="phone_number" value="{{ old('phone_number') }}"
                                        placeholder="Phone Number" class="form-control">
                                </div>
                            </div>
                            @error('phone_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="">Date of Birth <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="date" name="dob" value="{{ old('dob') }}" class="form-control">
                                </div>
                            </div>
                            @error('dob')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="">Password<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" name="password" placeholder="Password" class="form-control">
                                </div>
                            </div>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- EDIT MODAL --}}
        <div class="modal fade" id="editMerchantModal" tabindex="-1" aria-labelledby="editMerchantModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editMerchantModalLabel">Edit Merchant</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" id="update-form" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Fullname <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="fullname" value="" id="fullname"
                                        placeholder="Fullname" class="form-control">
                                </div>
                            </div>
                            @error('fullname')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="">Email Address <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="email" value="" id="email"
                                        placeholder="Email Address" class="form-control">
                                </div>
                            </div>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="">Phone Number <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="phone_number" value="" id="phone_number"
                                        placeholder="Phone Number" class="form-control">
                                </div>
                            </div>
                            @error('phone_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="">Date of Birth <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="date" name="dob" value="" id="dob"
                                        class="form-control">
                                </div>
                            </div>
                            @error('dob')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="">Password<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" name="password" placeholder="Password" class="form-control">
                                </div>
                            </div>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
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
            $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

            const merchantTable = window.LaravelDataTables['merchant_table'] = $('#merchant_table').DataTable();
            merchantTable.on('draw.dt', function() {

                $('.editBtn').click(function() {
                    fetch('/merchant/' + $(this).data('user'))
                        .then(response => response.json())
                        .then(merchant => {
                            $('#fullname').val(merchant.fullname);
                            $('#email').val(merchant.email);
                            $('#phone_number').val(merchant.phone_number);
                            $('#dob').val(merchant.dob);
                            $('#update-form').attr('action', '/merchant/' + $(this).data('user'));
                        })
                })
            })
        })
    </script>
@endpush
