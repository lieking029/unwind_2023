@extends('layouts.app')

@section('content')
<div class="main py-4">
    <div class="card  border-0 shadow table-wrapper table-responsive">
        <div class="card-header" style="padding-bottom: 5px">
            <h5 class="h5">{{ __('Merchants') }}</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>

        <div class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
