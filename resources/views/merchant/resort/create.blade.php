@extends('layouts.app')

@push('styles')
<style>
    span .selection {
        width: 100%;
    }

    .select2-container--default {
        width: 100%;
    }

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
<div class="bs-stepper shadow-lg">
    <div class="bs-stepper-header" role="tablist">
        <!-- your steps here -->
        <div class="step" data-target="#logins-part">
            <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                <span class="bs-stepper-circle">1</span>
                <span class="bs-stepper-label">Resort</span>
            </button>
        </div>
        <div class="step" data-target="#information-part">
            <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                <span class="bs-stepper-circle">2</span>
                <span class="bs-stepper-label">Location</span>
            </button>
        </div>
        <div class="step" data-target="#subhost">
            <button type="button" class="step-trigger" role="tab" aria-controls="subhost" id="subhost-trigger">
                <span class="bs-stepper-circle">3</span>
                <span class="bs-stepper-label">SubHost</span>
            </button>
        </div>
        <div class="step" data-target="#room">
            <button type="button" class="step-trigger" role="tab" aria-controls="room" id="room-trigger">
                <span class="bs-stepper-circle">4</span>
                <span class="bs-stepper-label">Room(s)</span>
            </button>
        </div>
        <div class="step" data-target="#amenity">
            <button type="button" class="step-trigger" role="tab" aria-controls="amenity" id="amenity-trigger">
                <span class="bs-stepper-circle">5</span>
                <span class="bs-stepper-label">Amenities</span>
            </button>
        </div>
        <div class="step" data-target="#addons">
            <button type="button" class="step-trigger" role="tab" aria-controls="addons" id="addons-trigger">
                <span class="bs-stepper-circle">6</span>
                <span class="bs-stepper-label">Addons</span>
            </button>
        </div>
    </div>
    <form action="{{ route('resorts.store') }}" method="POST">
        @csrf
        <div class="bs-stepper-content">
            <div id="logins-part" class="content" style="margin-left: 0" role="tabpanel" aria-labelledby="logins-part-trigger">
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
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror

                        <div class="form-group mt-2">
                            <label for="name">Resort Type <span style="color: red">*</span></label>
                            <select name="property_type_id" class="form-select" id="resort_type">
                                <option value="" disabled selected>Select Resort Type</option>
                                @foreach ($types as $type)
                                <option value="{{ $type->id }}" @selected(old('property_type_id')==$type->id)>
                                    {{ $type->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="price">Resort Price <span style="color: red">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="price" placeholder="Resort Price" value="{{ old('price') }}" autofocus>
                            </div>
                            @error('price')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="name">Type<span style="color: red">*</span></label>
                            <select name="type" class="form-control select2" id="type">
                                <option value="" disabled selected>Select Type</option>
                                <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Private</option>
                                <option value="2" {{ old('type') == '2' ? 'selected' : '' }}>Public</option>
                            </select>
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
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="mt-3 form-group">
                        <label>Featured Images/Videos</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="images" name="fMedia">
                        </div>
                    </div>
                    @error('fMedia')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary next" type="button" style="float: right">Next</button>
                </div>
            </div>
            <div id="information-part" class="content" role="tabpanel" style="margin-left: 0" aria-labelledby="information-part-trigger">
                <div class="row">
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
                        <textarea id="" cols="30" rows="4" class="form-control" name="loc_description" placeholder="Location Description">{{ old('loc_description') }}</textarea>
                    </div>
                    @error('loc_description')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="mt-3">
                        <button class="btn btn-primary next" type="button" style="float: right">Next</button>
                        <button class="btn btn-gray prev" type="button" style="float: right">Previous</button>
                    </div>
                </div>
            </div>
            <div id="subhost" role="tabpanel" aria-labelledby="subhost-trigger" class="content" style="margin-left: 0">
                <div class="row">
                    <div class="p-3">
                        <h5>SUB HOST</h5>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="">Sub-host Name</label>
                            <div class="input-group">
                                <input type="text" name="subhost_name" class="form-control" placeholder="Sub-host Name" value="{{ old('subhost_name') }}">
                            </div>
                        </div>
                        @error('subhost_name')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="form-group mt-2">
                            <label for="">Sub-host Email</label>
                            <div class="input-group">
                                <input type="text" name="subhost_email" class="form-control" placeholder="Sub-host subhost_email" value="{{ old('subhost_email') }}">
                            </div>
                        </div>
                        @error('subhost_email')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="">Sub-host Phone Number</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="subhost_phone_number" placeholder="Sub-host Phone Number" value="{{ old('subhost_phone_number') }}">
                            </div>
                        </div>
                        @error('subhost_phone_number')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="form-group mt-2">
                            <label for="">Sub-host Password</label>
                            <div class="input-group">
                                <input type="password" name="subhost_password" class="form-control" placeholder="Sub-host Password">
                            </div>
                        </div>
                        @error('subhost_password')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary next" type="button" style="float: right">Next</button>
                    <button class="btn btn-gray prev" type="button" style="float: right">Previous</button>
                </div>
            </div>
            <div class="content" id="room" aria-labelledby="room-trigger" style="margin-left: 0">
                <div class="row">
                    <div class="p-3">
                        <h5>ROOM</h5>
                    </div>
                    <div class="form-group">
                        <label for="">Image of the Room</label>
                        <input type="file" name="room[${roomLength}][rMedia]" class="form-control">
                    </div>
                    <div class="col mt-3">
                        <div class="form-group">
                            <label for="">Max Guest(s) Count</label>
                            <div class="input-group">
                                <input type="text" name="room[${roomLength}][max_guest_count]" class="form-control" placeholder="Max Guest Count">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Bath Count</label>
                            <div class="input-group">
                                <input type="text" name="room[${roomLength}][bath_count]" class="form-control" placeholder="Bath Count">
                            </div>
                        </div>
                    </div>
                    <div class="col mt-3">
                        <div class="form-group">
                            <label for="">Bed Count</label>
                            <div class="input-group">
                                <input type="text" name="room[${roomLength}][bed_count]" class="form-control" placeholder="Bed Count">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Room Price</label>
                            <div class="input-group">
                                <input type="text" name="room[${roomLength}][price]" class="form-control" placeholder="Price">
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary next" type="button" style="float: right">Next</button>
                        <button class="btn btn-gray prev" type="button" style="float: right">Previous</button>
                    </div>
                </div>
            </div>
            <div class="content" id="amenity" aria-labelledby="amenity-trigger" style="margin-left: 0">
                <div class="mt-3 row appended-amenities">
                    <h5>AMENITY</h5>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="amenity[${amenityLength}][am_name]" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary next" type="button" style="float: right">Next</button>
                    <button class="btn btn-gray prev" type="button" style="float: right">Previous</button>
                </div>
            </div>
            <div class="content" id="addons" aria-labelledby="addons-trigger" style="margin-left: 0" x-data="addOnsHandler()">
                <template x-for="(field, index) in addOns" :key="index">
                    <div class="mt-3 row appended-addons">
                        <h5>ADDON</h5>
                        <div class="col-8">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" :name="`addOn[${index}][name]`" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="text" :name="`addOn[${index}][price]`" class="form-control" placeholder="Price">
                            </div>
                        </div>
                    </div>
                </template>
                <button class="btn btn-primary" id="addonBtn" type="button" @click="addAddOns">New Addons</button>
                <div class="mt-3">
                    <button class="btn btn-primary" style="float: right" type="submit">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>


{{-- </div> --}}
@endsection

@push('scripts')
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script type="module">
    const stepper = new Stepper(document.querySelector('.bs-stepper'))

                $('.next').on('click', function() {
                    stepper.next();
                    console.log(stepper._currentIndex)
                });
                $('.prev').on('click', function() {
                    if (stepper._currentIndex > 0) {
                        stepper.to(stepper._currentIndex--);
                        console.log(stepper._currentIndex);
                    }
                })

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

    function addOnsHandler() {
        return {
            addOns: []
            , addAddOns() {
                this.addOns.push({
                    name: ''
                    , price: ''
                , })
            }
            , removeAddOns(addOnsIndex) {
                this.addOns.splice(addOnsIndex, 1);
            }
        }
    }

</script>
@endpush
