<div class="d-flex">
    <button class="btn me-2 btn-primary editBtn" type="button" data-bs-toggle="modal" data-bs-target="#editMerchantModal" data-user="{{ $user->id }}"><i class="fas fa-edit"></i></button>

    <form method="POST" action="{{ route('merchant.destroy', $user->id) }}" id="deleteForm-{{ $user->id }}">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="button" data-user="{{ $user->id }}" onclick="confirmDelete(event, {{ $user->id }})">
            <i class="fas fa-trash"></i>
        </button>
    </form>

    <script>
        function confirmDelete(event, userId) {
            event.preventDefault(); // Prevent the default form submission

            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to delete this Merchant?',
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
