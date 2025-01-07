@extends('layouts.app')
@section('content')
    @include('admin.partials.manage-tryouts')
@endsection

<script>
    let tryoutIdToDelete;
    let tryoutIdToEdit;

    // Fungsi untuk menampilkan modal konfirmasi hapus
    function confirmDeleteTryout(tryoutId) {
        tryoutIdToDelete = tryoutId;
        $('#deleteTryoutModal').modal('show');
    }

    // Fungsi untuk menampilkan modal edit
    function editTryout(tryoutId, tryoutName, tryoutDescription, tryoutStartDate, tryoutEndDate, tryoutPrice, tryoutIsPaid) {
        tryoutIdToEdit = tryoutId;
        $('#editTryoutId').val(tryoutId);
        $('#editName').val(tryoutName);
        $('#editDescription').val(tryoutDescription);
        $('#editStartDate').val(tryoutStartDate);
        $('#editEndDate').val(tryoutEndDate);
        $('#editPrice').val(tryoutPrice);
        $('#editIsPaid').prop('checked', tryoutIsPaid == 1);
        $('#editTryoutModal').modal('show');
    }

    // Fungsi untuk menampilkan modal tambah tryout
    function showAddTryoutModal() {
        $('#addTryoutForm')[0].reset();
        $('#addTryoutModal').modal('show');
    }

    // Fungsi untuk menghapus tryout
    $('#deleteTryoutButton').click(function(event) {
        event.preventDefault();
        $('#loading').addClass('active');
        $.ajax({
            url: `/admin/tryouts/${tryoutIdToDelete}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                console.log('Delete tryout success:', result);
                $('#deleteTryoutModal').modal('hide');
                $(`#tryout-row-${tryoutIdToDelete}`).fadeOut('slow', function() {
                    $(this).remove();
                });
                setTimeout(function() {
                    $('#loading').removeClass('active');
                }, 1000); // Delay 1 detik
                toastr.success(result.message);
            },
            error: function(xhr, status, error) {
                $('#loading').removeClass('active');
                console.error('Delete tryout error:', xhr.responseText);
                toastr.error(xhr.responseText);
            }
        });
    });

    // Fungsi untuk menyimpan perubahan tryout
    $('#saveChangesButtonTryout').click(function(event) {
        event.preventDefault();
        $('#loading').addClass('active');

        let formData = new FormData($('#editTryoutForm')[0]);

        $.ajax({
            url: `/admin/tryouts/${tryoutIdToEdit}`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function(result) {
                console.log('Update tryout success:', result);
                $('#editTryoutModal').modal('hide');
                setTimeout(function() {
                    $('#loading').removeClass('active');
                }, 1000); // Delay 1 detik
                toastr.success(result.message);
                location.reload();
            },
            error: function(xhr, status, error) {
                $('#loading').removeClass('active');
                console.error('Update tryout error:', xhr.responseText);
                toastr.error(xhr.responseText);
            }
        });
    });

    // Fungsi untuk menambah tryout
    $('#addTryoutButton').click(function(event) {
        event.preventDefault();
        $('#loading').addClass('active');

        let formData = new FormData($('#addTryoutForm')[0]);

        $.ajax({
            url: `/admin/tryouts`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function(result) {
                console.log('Add tryout success:', result);
                $('#addTryoutModal').modal('hide');
                setTimeout(function() {
                    $('#loading').removeClass('active');
                }, 1000); // Delay 1 detik
                toastr.success(result.message);
                location.reload();
            },
            error: function(xhr, status, error) {
                $('#loading').removeClass('active');
                console.error('Add tryout error:', xhr.responseText);
                toastr.error(xhr.responseText);
            }
        });
    });
</script>
