@extends('layouts.app')

@section('content')

<div class="container-fluid card">
    <div class="card-header row" style="padding-bottom: 5px">
        <div class="col">
            <h5>Resorts</h5>
        </div>
        <div class="col text-end">
            <a href="{{ route('resorts.create') }}" class="btn btn-primary">Add Resort</a>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Property</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

@endsection
