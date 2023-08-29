@extends('layouts.app')

@section('content')
    <div class="container-fluid card">
        <div class="card-header row" style="padding-bottom: 5px">
            <div class="col">
                <h5>Properties</h5>
            </div>
            <div class="col text-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#propertyModal">
                    Add Property
                </button>
                {{-- <a href="{{ route('property.create') }}" class="btn btn-primary">Add Property</a> --}}
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>
        <div class="modal fade" id="propertyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="propertyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title h4" id="propertyModalLabel">{{ __('Choose your Property type') }}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                            <a href="" class="btn btn-primary col-6 py-5"><h4 class="text-white">{{ __('Resort') }}</h4></a>
                            <a href="" class="btn btn-info col-6 py-5"><h4 class="text-white">{{ __('Hotel Room') }}</h4></a>
                            <a href="" class="btn btn-warning col-6 py-5"><h4 class="text-white">{{ __('Motel Room') }}</h4></a>
                            <a href="" class="btn btn-success col-6 py-5"><h4 class="text-white">{{ __('Condominium') }}</h4></a>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
