@extends('layouts.app')

@section('content')

<div class="container-fluid card">
    <div class="card-header row" style="padding-bottom: 5px">
        <div class="col">
            <h5>Resorts</h5>
        </div>
        <div class="col text-end">
            <a href="{{ route('resort.create') }}" class="btn btn-primary">Add Resort</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>

@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
