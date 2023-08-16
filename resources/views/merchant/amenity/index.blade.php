@extends('layouts.app')

@section('content')

<div class="container-fluid card">
    <div class="card-header row">
        <div class="col">
            <h4>Amenity</h4>
        </div>
        <div class="col">
            <button class="btn btn-primary" style="float: right" data-bs-toggle="modal" data-bs-target="#amenityModal"><i class="fas fa-plus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            {{ $dataTable->table() }}
        </div>
    </div>


    {{-- CREATE AMENITY MODAL --}}
    <div class="modal fade" id="amenityModal" tabindex="-1" aria-labelledby="amenityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="amenityModalLabel">Modal title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('amenity.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <div class="input-group">
                            <input type="text" placeholder="Name" name="name" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
          </div>
        </div>
      </div>

      {{-- EDIT AMENITY MODAL --}}
      <div class="modal fade" id="editAmenityModal" tabindex="-1" aria-labelledby="editAmenityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editAmenityModalLabel">Modal title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="update-form">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <div class="input-group">
                            <input type="text" placeholder="Name" id="name" name="name" class="form-control">
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
          </div>
        </div>
      </div>

</div>

@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}

<script type="module">
    $(() => {

            const amenityTable = window.LaravelDataTables['amenity_table'] = $('#amenity_table').DataTable();
            amenityTable.on('draw.dt', function() {

                $('.editBtn').click(function() {
                    fetch('/amenity/' + $(this).data('amenity'))
                    .then(response => response.json())
                    .then(amenity => {
                        $('#name').val(amenity.name);
                        $('#update-form').attr('action', '/amenity/' + $(this).data('amenity'));
                    })
                })
            })

        })
    </script>

@endpush
