let userIdToDelete;
let userIdToEdit;

// Fungsi untuk menampilkan modal konfirmasi hapus
function confirmDelete(userId) {
    userIdToDelete = userId;
    $('#deleteModal').modal('show');
}

// Fungsi untuk menampilkan modal edit
function editUser(userId, userName, userEmail) {
    userIdToEdit = userId;
    $('#editUserId').val(userId);
    $('#editUserName').val(userName);
    $('#editUserEmail').val(userEmail);
    $('#editModal').modal('show');
}

// Fungsi untuk menampilkan modal tambah pengguna
function showAddUserModal() {
    $('#addUserForm')[0].reset();
    $('#addUserModal').modal('show');
}

document.getElementById('deleteButton').addEventListener('click', function(event) {
    event.preventDefault();

    $('#loading').addClass('active');
    // Lakukan panggilan AJAX untuk menghapus pengguna berdasarkan userIdToDelete
    $.ajax({
        url: `/admin/users/${userIdToDelete}`,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(result) {
            // Sembunyikan modal
            $('#deleteModal').modal('hide');
            $(`#user-row-${userIdToDelete}`).fadeOut('slow', function() {
                $(this).remove();
            });
            setTimeout(function() {
                $('#loading').removeClass('active');
            }, 1000); // Delay 1 detik
        },
        error: function(xhr, status, error) {
            // Tangani kesalahan
            $('#loading').removeClass('active');
            alert('Failed to delete user');
        }
    });
});

document.getElementById('saveChangesButton').addEventListener('click', function(event) {
    event.preventDefault();

    $('#loading').addClass('active');

    let userId = $('#editUserId').val();
    let userName = $('#editUserName').val();
    let userEmail = $('#editUserEmail').val();

    // Lakukan panggilan AJAX untuk mengupdate pengguna
    $.ajax({
        url: `/admin/users/${userId}`,
        type: 'PUT',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            name: userName,
            email: userEmail
        },
        success: function(result) {
            // Sembunyikan modal
            $('#editModal').modal('hide');
            // Perbarui baris tabel dengan data yang diupdate
            $(`#user-row-${userId} td:nth-child(1) span`).text(userName);
            $(`#user-row-${userId} td:nth-child(2) span`).text(userEmail);
            setTimeout(function() {
                $('#loading').removeClass('active');
            }, 1000); // Delay 1 detik
        },
        error: function(xhr, status, error) {
            // Tangani kesalahan
            $('#loading').removeClass('active');
            alert('Failed to update user');
        }
    });
});

document.getElementById('addUserButton').addEventListener('click', function(event) {
    event.preventDefault();

    $('#loading').addClass('active');

    let userName = $('#addUserName').val();
    let userEmail = $('#addUserEmail').val();

    // Lakukan panggilan AJAX untuk menambah pengguna
    $.ajax({
        url: `/admin/users`,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            name: userName,
            email: userEmail
        },
        success: function(result) {
            // Sembunyikan modal
            $('#addUserModal').modal('hide');
            // Tambahkan baris baru ke tabel
            $('#userTable tbody').append(`
                <tr id="user-row-${result.id}">
                    <td>
                        <div class="flex-align gap-8">
                            <img src="https://html.themeholy.com/edmate/assets/images/thumbs/student-img1.png" alt="" class="w-40 h-40 rounded-circle">
                            <span class="h6 mb-0 fw-medium text-gray-300">${result.name}</span>
                        </div>
                    </td>
                    <td>
                        <span class="h6 mb-0 fw-medium text-gray-300">${result.email}</span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-8">
                            <button class="btn btn-danger" onclick="confirmDelete('${result.id}')"><i class="fas fa-trash"></i></button>
                            <button class="btn btn-success" onclick="editUser('${result.id}', '${result.name}', '${result.email}')"><i class="fas fa-edit"></i></button>
                        </div>
                    </td>
                </tr>
            `);
            setTimeout(function() {
                $('#loading').removeClass('active');
            }, 1000); // Delay 1 detik
        },
        error: function(xhr, status, error) {
            // Tangani kesalahan
            $('#loading').removeClass('active');
            alert('Failed to add user');
        }
    });
});
</script>
