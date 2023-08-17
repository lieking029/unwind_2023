@extends('layouts.app')

@push('styles')
<style>
    span .selection {
        width: 100%;
    }

    /* .select2-container--default {
        width: 100%;
    } */

    .select2-selection__rendered {
        line-height: 34px !important;
    }

    .select2-container .select2-selection--single {
        height: 39px !important;
    }

    .select2-selection__arrow {
        height: 36px !important;
        margin-right: 20px;
    }

    .inventory_item.selected_tr {
        background: gray;
        opacity: 0.5;
    }

    textarea.is-invalid {
        border-color: red !important;
    }

</style>

@endpush

@section('content')
<div class="container-fluid card shadow-lg">
    <div class="card-header">
        <h3>RESORT</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('resort.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="p-3">
                    <h5>RESORT DETAILS</h5>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="name">Resort Name <span style="color: red">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="name" placeholder="Resort Name" value="{{ old('name') }}" autofocus>
                        </div>
                    </div>
                    @error('name')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror

                    <div class="form-group mt-2">
                        <label for="name">Resort Type <span style="color: red">*</span></label>
                        <select name="property_type_id" class="form-select" id="resort_type">
                            <option value="" disabled selected>Select Resort Type</option>
                        @foreach ($data['propertyTypes'] as $type)
                            <option value="{{ $type->id }}" @selected(old('property_type_id') == $type->id)>
                                {{ $type->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('property_type_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="price">Resort Price <span style="color: red">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="price" placeholder="Resort Price" value="{{ old('price') }}" autofocus>
                        </div>
                        @error('price')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="name">Type<span style="color: red">*</span></label>
                        <select name="visibility" class="form-select" id="type">
                            <option value="" disabled selected>Select Type</option>
                            @foreach(\App\Enums\ResortVisibilityEnum::asSelectArray() as $value => $label)
                            <option value="{{ $value }}" @selected(old('visibility') == $value) >{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('type')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <input type="checkbox" name="" style="margin-top: 5px" id="checked" {{ old('visibility') ? 'checked' : '' }}>
                        <input type="hidden" name="visibility" id="visibilityValueInput" value="{{ old('visibility') ? 1 : 0 }}">
                        <span style="font-size: 12px">Has 12 hours cancelation policy?</span>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="description">Resort Description<span style="color: red">*</span></label>
                    <textarea name="description" class="form-control" id="" cols="15" rows="5" placeholder="Resort Description">{{ old('description') }}</textarea>
                </div>
                @error('description')
                <small class="text-danger">
                    {{ $message }}
                </small>
                @enderror
                <div class="mt-3 form-group">
                    <label>Featured Images/Videos</label>
                    <div class="input-group">
                        <input type="file" class="form-control filepond" id="attachments_create" name="featured_media[]" multiple>
                    </div>
                </div>
                @error('featured_media')
                <small class="text-danger">
                    {{ $message }}
                </small>
                @enderror
            </div>

            <div class="row mt-4">
                <div class="p-3">
                    <h5>LOCATION DETAILS</h5>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="">Street Number</label>
                        <div class="input-group">
                            <input type="text" name="street_number" placeholder="Street Number" class="form-control" value="{{ old('street_number') }}">
                        </div>
                    </div>
                    @error('street_number')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="form-group mt-2">
                        <label for="">Barangay District</label>
                        <div class="input-group">
                            <input type="text" name="barangay_district" placeholder="Barangay District" class="form-control" value="{{ old('barangay_district') }}">
                        </div>
                    </div>
                    @error('barangay_district')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="">Postal Code</label>
                        <div class="input-group">
                            <input type="text" name="postal_code" placeholder="Postal Code" class="form-control" value="{{ old('postal_code') }}">
                        </div>
                    </div>
                    @error('postal_code')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="form-group mt-2">
                        <label for="">Street Name</label>
                        <div class="input-group">
                            <input type="text" name="street_name" placeholder="Street Name" class="form-control" value="{{ old('street_name') }}">
                        </div>
                    </div>
                    @error('street_name')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="">Location Description</label>
                    <textarea id="" cols="30" rows="4" class="form-control" name="location_description" placeholder="Location Description">{{ old('location_description') }}</textarea>
                </div>
                @error('location_description')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mt-4">
                <div class="p-3">
                    <h5>SUB-HOST</h5>
                </div>
                <div class="form-group">
                    <label for="">Sub-Host</label>
                    <select name="subhost_id[]" id="" class="select2 form-select" multiple>
                        <option value="" selected disabled>Select Sub-Host</option>
                        @foreach ($data['subHosts'] as $subHost)
                        <option value="{{ $subHost->id }}" {{ in_array($subHost->id, old('subhost_id', [])) ? 'selected' : '' }}>{{ $subHost->fullname }}</option>
                        @endforeach
                    </select>
                    @error('subhost_id')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="mt-4">
                <div class="p-3">
                    <h5>AMENITIES</h5>
                </div>
                <div class="form-group">
                    <label for="">Amenities</label>
                    <select name="amenities[]" id="" class="select2 form-select" multiple>
                        <option value="" selected disabled>Select Amenity</option>
                        @foreach ($data['amenities'] as $amenity)
                        <option value="{{ $amenity->id }}" {{ in_array($amenity->id, old('amenities', [])) ? 'selected' : '' }}>{{ $amenity->name }}</option>
                        @endforeach
                    </select>
                    @error('amenities')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="mt-4">
                <div class="p-3">
                    <h5>ADDONS</h5>
                </div>
                <div class="form-group">
                    <label for="">Addons</label>
                    <select name="addons[]" id="" class="select2 form-select" multiple>
                        <option value="" selected disabled>Select Addon</option>
                        @foreach ($data['addons'] as $addon)
                        <option value="{{ $addon->id }}" {{ in_array($addon->id, old('addons', [])) ? 'selected' : '' }}>{{ $addon->name }}</option>
                        @endforeach
                    </select>
                    @error('addons')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="mt-3">
                <button class="btn btn-primary" style="float: right" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>


{{-- </div> --}}
@endsection

@push('scripts')
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

<script type="module">
    $(document).ready(function() {

        const checkbox = $('#checked');
        const visibilityValueInput = $('#visibilityValueInput');

        visibilityValueInput.val(checkbox.prop('checked') ? 1 : 0);

        $('#checked').on('click', function() {
            visibilityValueInput.val(this.checked ? 1 : 0);
        });
    })

</script>

<script>
    $('.select2').select2();

    $(() => {

        FilePond.create(document.getElementById('attachments_create'));

        FilePond.setOptions({
            server: {
                    url: '/upload',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                        const formData = new FormData();
                        formData.append('featured_media', file, file.name);

                        const request = new XMLHttpRequest();
                        request.open('POST', '/upload');
                        request.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                        request.upload.onprogress = (e) => {
                            progress(e.lengthComputable, e.loaded, e.total);
                        };


                        request.onload = function () {
                            if (request.status >= 200 && request.status < 300) {
                                load(request.responseText);
                            } else {
                                error('oh no');
                            }
                        };

                        request.send(formData);
                        return {
                            abort: () => {
                                request.abort();
                                abort();
                            },
                        };
                    },
                },
            })
    })

</script>

@endpush
