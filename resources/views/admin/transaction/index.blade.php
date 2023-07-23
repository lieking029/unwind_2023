@extends('layouts.app')


@section('content')

<div class="container-fluid card">
    <div class="card-header" style="padding-bottom: 5px">
        <h5>Transactions</h5>
    </div>
    <div class="card-body">
        <table class="table table-hover" id="dataTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Merchant</th>
                    <th>Amount Due</th>
                    <th>Payment Method</th>
                    <th>Reference No.</th>
                    <th>Resort</th>
                    <th>Date</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection
