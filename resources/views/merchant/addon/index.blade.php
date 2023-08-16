@extends('layouts.app')

@section('content')

<div class="container-fluid card">
    <div class="card-header row">
        <div class="col">
            <h4>Addons</h4>
        </div>
        <div class="col">
            <button class="btn btn-primary" style="float: right" data-bs-toggle="modal" data-bs-target="#addonModal"><i class="fas fa-plus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            {{ $dataTable->table() }}
        </div>
    </div>

    {{-- CREATE ADDON MODAL --}}
    <div class="modal fade" id="addonModal" tabindex="-1" aria-labelledby="addonModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addonModalLabel">Add Addon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Name</label>
                            <div class="input-group">
                                <input type="text" name="name" placeholder="Name" class="form-control">
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

    {{-- EDIT ADDON MODAL --}}
    <div class="modal fade" id="editAddonModal" tabindex="-1" aria-labelledby="editAddonModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editAddonModalLabel">Edit Addon</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="update-form">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <div class="input-group">
                            <input type="text" name="name" id="name" class="form-control">
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

        const addonTable = window.LaravelDataTables['addon_table'] = $('#addon_table').DataTable();
        addonTable.on('draw.dt', function() {

            $('.editBtn').click(function() {
                fetch('/addon/' + $(this).data('addon'))
                .then(response => response.json())
                .then(addon => {
                    $('#name').val(addon.name);
                    $('#update-form').attr('action', '/addon/' + $(this).data('addon'));
                })
            })
        })
    })
</script>

@endpush
