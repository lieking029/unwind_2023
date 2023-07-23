@extends('layouts.app')

@section('content')
<div class="main py-4">
    <div class="row mb-4">
        @admin
        <div class="col card mx-2">
            <div class="card-header" style=" padding-bottom: 5px">
                <label for="" style=" font-size: 15px;">Total Clients</label>
            </div>
            <div class="card-body">
                <i class="fas fa-users" style="margin-right: 10px; font-size: 25px"></i>
                <label for="">{{ $clients }}</label>
            </div>
        </div>
        <div class="col card mx-2">
            <div class="card-header" style=" padding-bottom: 5px">
                <label for="" style="color: orange; font-size: 15px;">Total Merchants</label>
            </div>
            <div class="card-body">
                <i class="fas fa-user-tie" style="margin-right: 10px; color: orange; font-size: 25px"></i>
                <label for="" style="color: orange">{{ $merchants }}</label>
            </div>
        </div>
        <div class="col card mx-2">
            <div class="card-header" style=" padding-bottom: 5px">
                <label for="" style="color: green; font-size: 15px;">Monthly Income</label>
            </div>
            <div class="card-body">
                <i class="fas fa-money-bill-wave-alt" style="margin-right: 10px; color: green; font-size: 25px"></i>
                <label for="" style="color: green">₱ 0</label>
            </div>
        </div>
        <div class="col card mx-2">
            <div class="card-header" style=" padding-bottom: 5px">
                <label for="" style="color: blue; font-size: 15px;">New Sales</label>
            </div>
            <div class="card-body">
                <i class="fas fa-shopping-cart" style="margin-right: 10px; color: blue; font-size: 25px"></i>
                <label for="" style="color: blue">0</label>
            </div>
        </div>
        @endadmin
        @merchant

        <div class="col card mx-2">
            <div class="card-header" style=" padding-bottom: 5px">
                <label for="" style=" font-size: 15px;">Total Clients</label>
            </div>
            <div class="card-body">
                <i class="fas fa-users" style="margin-right: 10px; font-size: 25px"></i>
                <label for="">{{ $clients }}</label>
            </div>
        </div>
        <div class="col card mx-2">
            <div class="card-header" style=" padding-bottom: 5px">
                <label for="" style="color: green; font-size: 15px;">Monthly Income</label>
            </div>
            <div class="card-body">
                <i class="fas fa-money-bill-wave-alt" style="margin-right: 10px; color: green; font-size: 25px"></i>
                <label for="" style="color: green">₱ 0</label>
            </div>
        </div>

        <div class="col card mx-2">
            <div class="card-header" style=" padding-bottom: 5px">
                <label for="" style="color: rgb(5, 35, 169); font-size: 15px;">New Sales</label>
            </div>
            <div class="card-body">
                <i class="fas fa-shopping-cart" style="margin-right: 10px; color: rgb(5, 35, 169); font-size: 25px"></i>
                <label for="" style="color: rgb(5, 35, 169)">0</label>
            </div>
        </div>

        <div class="col card mx-2">
            <div class="card-header" style=" padding-bottom: 5px">
                <label for="" style="color: rgb(0, 133, 145); font-size: 15px;">Pending Book</label>
            </div>
            <div class="card-body">
                <i class="fas fa-comments" style="margin-right: 10px; color: rgb(0, 133, 145); font-size: 25px"></i>
                <label for="" style="color: rgb(0, 133, 145)">0</label>
            </div>
        </div>

        @endmerchant
    </div>

    <div class="container-fluid card">
        <div class="card-header" style="padding-bottom: 5px">
            <h5>Resorts</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <td>Resord</td>
                        <td>Type</td>
                        <td>Action</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

</div>
@endsection
