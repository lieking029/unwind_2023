@extends('layouts.app')

@section('content')

<div class="container-fluid card">
    <div class="card-header">
        <h5>Bookings</h5>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-hover" id="dataTable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Resort</th>
                    <th>Client</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Price</th>
                    <th>Reference No.</th>
                    <th>Participants Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <script>
    </script>
</div>

@endsection
