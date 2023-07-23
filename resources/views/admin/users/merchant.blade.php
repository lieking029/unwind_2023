@extends('layouts.app')

@section('content')
<div class="main py-4">
    <div class="card  border-0 shadow table-wrapper table-responsive">
        <div class="card-header" style="padding-bottom: 5px">
            <h5 class="h5">{{ __('Merchants') }}</h5>
        </div>

        <div class="card-body">
            {{ $dataTable->table() }}

            {{-- <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th class="border-gray-200">{{ __('Name') }}</th>
                        <th class="border-gray-200">{{ __('Email') }}</th>
                        <th class="border-gray-200">{{ __('Phone Number') }}</th>
                        <th class="border-gray-200">{{ __('Resorts') }}</th>
                        <th class="border-gray-200">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($merchants as $merchant)
                    <tr>
                        <td><span class="fw-normal">{{ $merchant->fullname }}</span></td>
                        <td><span class="fw-normal">{{ $merchant->email }}</span></td>
                        <td><span class="fw-normal">{{ $merchant->phone_number }}</span></td>
                        <td><span class="fw-normal">1</span></td>
                        <td>
                            <a href="" class="btn btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table> --}}
        </div>

        <div class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
        </div>
    </div>
</div>
@endsection
