<div class="d-flex">
    <button type="button"  class="btn me-2 btn-primary editBtn" data-resort="{{ $resort->id }}" data-bs-toggle="modal" data-bs-target="#editResortModal"><i class="fas fa-edit"></i></button>

    <form method="POST" action="{{ route('resort.destroy', $resort->id) }}" id="deleteForm-{{ $resort->id }}">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="button" data-resort="{{ $resort->id }}" onclick="confirmDelete(event, {{ $resort->id }})">
            <i class="fas fa-trash"></i>
        </button>
    </form>


    <div class="modal fade" id="editResortModal" tabindex="-1" aria-labelledby="editResortModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editResortModalLabel">Choose What to edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <a href="{{ route('resort.edit', $resort->id) }}" class="btn btn-primary p-3 text-white" style="width: 100%; font-weight: 600">Edit Resort Details</a>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('room.edit', $resort->id) }}" class="btn btn-info p-3 text-white" style="width: 100%; font-weight: 600">Edit / Add Rooms</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(event, userId) {
            event.preventDefault(); // Prevent the default form submission

            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to delete this Resort?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`deleteForm-${userId}`).submit();
                }
            });
        }
    </script>
</div>
