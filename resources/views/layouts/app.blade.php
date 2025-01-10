<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BarDev</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/file-upload.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plyr.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/full-calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/editor-quill.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/apexcharts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-jvectormap-2.0.5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .loading-area {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.5s ease-in-out; /* Transisi yang halus */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .loading-area.active {
            opacity: 1;
            pointer-events: all;
        }
        .loader div {
            height: 30px;
            width: 30px;
            border-radius: 50%;
            transform: scale(0);
            animation: animate 1.5s ease-in-out infinite;
            display: inline-block;
            margin: .5rem;
        }
        .loader div:nth-child(0) {
            animation-delay: 0s;
        }
        .loader div:nth-child(1) {
            animation-delay: 0.2s;
        }
        .loader div:nth-child(2) {
            animation-delay: 0.4s;
        }
        .loader div:nth-child(3) {
            animation-delay: 0.6s;
        }
        .loader div:nth-child(4) {
            animation-delay: 0.8s;
        }
        .loader div:nth-child(5) {
            animation-delay: 1s;
        }
        .loader div:nth-child(6) {
            animation-delay: 1.2s;
        }
        .loader div:nth-child(7) {
            animation-delay: 1.4s;
        }
        @keyframes animate {
            0%, 100% {
                transform: scale(0.2);
                background-color: #BD0036;
            }
            40% {
                transform: scale(1);
                background-color: #F25330;
            }
            50% {
                transform: scale(1);
                background-color: #F2B900;
            }
        }
        .fade-out {
            animation: fadeOut 0.5s forwards;
        }
        .fade-in {
            animation: fadeIn 0.5s forwards;
        }
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .sidebar-menu__item.active .sidebar-menu__link {
            background-color: #3E80F9; /* Warna latar belakang untuk menu yang aktif */
            color: #fff; /* Warna teks untuk menu yang aktif */
        }
    </style>
</head> 
<body>
    @include('layouts.header')
    @include('layouts.sidebar')
    @include('layouts.topbar')
    <div id="content-area">
        @yield('content')
    </div>
    @include('layouts.footer')

    <div id="loading" class="loading-area">
        <div class="loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#logoutButton').on('click', function(event) {
                event.preventDefault();

                $('#loading').addClass('active');
                
                $.ajax({
                    url: $('#logoutForm').attr('action'),
                    method: 'POST',
                    data: $('#logoutForm').serialize(),
                    success: function(response) {
                        if (response.message === 'Logout successful') {
                            setTimeout(function() {
                                $('body').html(response.html);
                                history.pushState(null, null, '{{ url("/admin/login") }}');
                                $('#loading').removeClass('active');
                            }, 1000);
                        } else {
                            $('#loading').removeClass('active');
                            alert('Logout failed');
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#loading').removeClass('active');
                        alert('Logout failed');
                    }
                });
            });

            $('.sidebar-menu__link').on('click', function(event) {
                event.preventDefault();

                let url = $(this).attr('href');

                $('#loading').addClass('active');
                $('#content-area').addClass('fade-out');

                // Hapus kelas aktif dari semua item menu
                $('.sidebar-menu__item').removeClass('active');

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        setTimeout(function() {
                            $('#content-area').empty().html(response.html); // pastikan menggunakan .html dari JSON
                            history.pushState(null, null, url);
                            $('#loading').removeClass('active');
                            $('#content-area').removeClass('fade-out').addClass('fade-in');

                            // Tambahkan kelas aktif ke menu yang diklik
                            $('a[href="' + url + '"]').closest('.sidebar-menu__item').addClass('active');
                        }, 500);
                    },
                    error: function(xhr, status, error) {
                        $('#loading').removeClass('active');
                        alert('Failed to load content');
                    }
                });
            });

            // Fungsi untuk menambahkan kelas aktif berdasarkan URL saat ini
            function setActiveMenuItem() {
                var currentUrl = window.location.pathname;

                $('.sidebar-menu__item').removeClass('active');
                $('a[href="' + currentUrl + '"]').closest('.sidebar-menu__item').addClass('active');
            }

            // Panggil fungsi saat halaman dimuat ulang
            setActiveMenuItem();

            // Tangani perubahan popstate (misalnya, saat pengguna menekan tombol kembali/maju di browser)
            window.addEventListener('popstate', function() {
                setActiveMenuItem();
            });

        });
    </script>

    <!-- Modal Konfirmasi Hapus Pengguna -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="deleteButton">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Pengguna -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        <div class="mb-3">
                            <label for="editUserName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editUserName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editUserEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editUserEmail" required>
                        </div>
                        <input type="hidden" id="editUserId">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveChangesButton">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Pengguna -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm">
                        <div class="mb-3">
                            <label for="addUserName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="addUserName" required>
                        </div>
                        <div class="mb-3">
                            <label for="addUserEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="addUserEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="addUserPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="addUserPassword" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="addUserButton">Add User</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Tryout -->
    <div class="modal fade" id="addTryoutModal" tabindex="-1" aria-labelledby="addTryoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTryoutModalLabel">Add Tryout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addTryoutForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_paid" name="is_paid">
                            <label class="form-check-label" for="is_paid">Is Paid</label>
                        </div>
                        <button type="button" class="btn btn-primary" id="addTryoutButton">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Tryout -->
    <div class="modal fade" id="editTryoutModal" tabindex="-1" aria-labelledby="editTryoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTryoutModalLabel">Edit Tryout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editTryoutForm">
                        <input type="hidden" id="editTryoutId" name="id">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editDescription" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editStartDate" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="editStartDate" name="start_date">
                        </div>
                        <div class="mb-3">
                            <label for="editEndDate" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="editEndDate" name="end_date">
                        </div>
                        <div class="mb-3">
                            <label for="editImage" class="form-label">Image</label>
                            <input type="file" class="form-control" id="editImage" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="editPrice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="editPrice" name="price" step="0.01" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="editIsPaid" name="is_paid">
                            <label class="form-check-label" for="editIsPaid">Is Paid</label>
                        </div>
                        <button type="button" class="btn btn-primary" id="saveChangesButtonTryout">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus Tryout -->
    <div class="modal fade" id="deleteTryoutModal" tabindex="-1" aria-labelledby="deleteTryoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTryoutModalLabel">Delete Tryout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this tryout?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="deleteTryoutButton">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kategori -->
    {{-- <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="duration" class="form-label">Duration (in minutes)</label>
                            <input type="number" class="form-control" id="duration" name="duration" required>
                        </div>
                        <div class="mb-3">
                            <label for="tryout_id" class="form-label">Tryout</label>
                            <select class="form-control" id="tryout_id" name="tryout_id" required>
                                @foreach($tryouts as $tryout)
                                    <option value="{{ $tryout->id }}">{{ $tryout->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary" id="addCategoryButton">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Modal Edit Kategori -->
    {{-- <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editCategoryId" name="id">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editDescription" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editDuration" class="form-label">Duration (in minutes)</label>
                            <input type="number" class="form-control" id="editDuration" name="duration" required>
                        </div>
                        <div class="mb-3">
                            <label for="editTryoutId" class="form-label">Tryout</label>
                            <select class="form-control" id="editTryoutId" name="tryout_id" required>
                                @foreach($tryouts as $tryout)
                                    <option value="{{ $tryout->id }}">{{ $tryout->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary" id="saveChangesButtonCategory">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Modal Konfirmasi Hapus Kategori -->
    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCategoryModalLabel">Delete Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this category?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="deleteCategoryButton">Delete</button>
                </div>
            </div>
        </div>
    </div>




    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
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
        $(document).on('click', '#deleteTryoutButton', function(event) {
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
                    }, 2000); // Delay 2 detik
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
        $(document).on('click', '#saveChangesButtonTryout', function(event) {
            event.preventDefault();
            $('#loading').addClass('active');
    
            let formData = new FormData($('#editTryoutForm')[0]);
            formData.set('is_paid', $('#editIsPaid').is(':checked') ? 1 : 0);
    
            $.ajax({
                url: `/admin/tryouts/${tryoutIdToEdit}`,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-HTTP-Method-Override': 'PUT'
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                    console.log('Update tryout success:', result);
                    $('#editTryoutModal').modal('hide');
                    setTimeout(function() {
                        $('#loading').removeClass('active');
                    }, 2000); // Delay 2 detik
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
        $(document).on('click', '#addTryoutButton', function(event) {
            event.preventDefault();
            $('#loading').addClass('active');
    
            let formData = new FormData($('#addTryoutForm')[0]);
            formData.set('is_paid', $('#is_paid').is(':checked'));
    
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
                    }, 2000); // Delay 2 detik
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
        
        // Fungsi untuk pencarian
        document.getElementById('searchInput').addEventListener('keyup', function() {
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById('searchInput');
            filter = input.value.toUpperCase();
            table = document.getElementById('tryoutTable');
            tr = table.getElementsByTagName('tr');

            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = 'none';
                td = tr[i].getElementsByTagName('td');
                for (j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = '';
                            break;
                        }
                    }
                }
            }
        });
        // Fungsi untuk mengurutkan tabel
        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById('tryoutTable');
            switching = true;
            dir = 'asc'; 

            while (switching) {
                switching = false;
                rows = table.rows;

                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName('TD')[n];
                    y = rows[i + 1].getElementsByTagName('TD')[n];

                    if (dir == 'asc') {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == 'desc') {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }

                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount++;
                } else {
                    if (switchcount == 0 && dir == 'asc') {
                        dir = 'desc';
                        switching = true;
                    }
                }
            }
        }
    </script>

    <script>
        toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    let userIdToDelete;
    let userIdToEdit;

    function confirmDelete(userId) {
        userIdToDelete = userId;
        $('#deleteModal').modal('show');
    }

    function editUser(userId, userName, userEmail) {
        userIdToEdit = userId;
        $('#editUserId').val(userId);
        $('#editUserName').val(userName);
        $('#editUserEmail').val(userEmail);
        $('#editModal').modal('show');
    }

    function showAddUserModal() {
        $('#addUserForm')[0].reset();
        $('#addUserModal').modal('show');
    }

    $('#deleteButton').on('click', function(event) {
        event.preventDefault();
        $('#loading').addClass('active');

        $.ajax({
            url: `/admin/users/${userIdToDelete}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                $('#deleteModal').modal('hide');
                $(`#user-row-${userIdToDelete}`).fadeOut('slow', function() {
                    $(this).remove();
                });
                toastr.success('Pengguna berhasil dihapus!', 'Berhasil');
            },
            error: function(xhr, status, error) {
                toastr.error('Gagal menghapus pengguna', 'Error');
            },
            complete: function() {
                $('#loading').removeClass('active');
            }
        });
    });

    $('#saveChangesButton').on('click', function(event) {
        event.preventDefault();
        $('#loading').addClass('active');

        let userId = $('#editUserId').val();
        let userName = $('#editUserName').val();
        let userEmail = $('#editUserEmail').val();

        $.ajax({
            url: `/admin/users/${userId}`,
            type: 'PUT',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { name: userName, email: userEmail },
            success: function(result) {
                $('#editModal').modal('hide');
                $(`#user-row-${userId} td:nth-child(1) span`).text(userName);
                $(`#user-row-${userId} td:nth-child(2) span`).text(userEmail);
                toastr.success('Data pengguna berhasil diperbarui!', 'Berhasil');
            },
            error: function(xhr, status, error) {
                toastr.error('Gagal memperbarui data pengguna', 'Error');
            },
            complete: function() {
                $('#loading').removeClass('active');
            }
        });
    });

    $('#addUserButton').on('click', function(event) {
        event.preventDefault();
        $('#loading').addClass('active');

        let userName = $('#addUserName').val();
        let userEmail = $('#addUserEmail').val();
        let userPassword = $('#addUserPassword').val();

        $.ajax({
            url: `/admin/users`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { name: userName, email: userEmail, password: userPassword },
            success: function(result) {
                $('#addUserModal').modal('hide');
                $('#userTable tbody').append(`
                    <tr id="user-row-${result.data.id}">
                        <td>
                            <div class="flex-align gap-8">
                                <img src="https://html.themeholy.com/edmate/assets/images/thumbs/student-img1.png" alt="" class="w-40 h-40 rounded-circle">
                                <span class="h6 mb-0 fw-medium text-gray-300">${result.data.name}</span>
                            </div>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">${result.data.email}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-8">
                                <button class="bg-main-50 text-danger-600 py-3 px-14 rounded hover-bg-danger-600 hover-text-white" onclick="confirmDelete('${result.data.id}')"><i class="fas fa-trash"></i></button>
                                <button class="bg-primary-100 text-success py-3 px-14 rounded hover-bg-success-600 hover-text-white" onclick="editUser('${result.data.id}', '${result.data.name}', '${result.data.email}')"><i class="fas fa-edit"></i></button>
                            </div>
                        </td>
                    </tr>
                `);
                toastr.success('Pengguna berhasil ditambahkan!', 'Berhasil');
            },
            error: function(xhr, status, error) {
                toastr.error('Gagal menambahkan pengguna', 'Error');
            },
            complete: function() {
                $('#loading').removeClass('active');
            }
        });
    });

    document.getElementById('searchInput').addEventListener('keyup', function() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById('searchInput');
        filter = input.value.toUpperCase();
        table = document.getElementById('userTable');
        tr = table.getElementsByTagName('tr');

        for (i = 1; i < tr.length; i++) {
            tr[i].style.display = 'none';
            td = tr[i].getElementsByTagName('td');
            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = '';
                        break;
                    }
                }
            }
        }
    });

    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById('userTable');
        switching = true;
        dir = 'asc';

        while (switching) {
            switching = false;
            rows = table.rows;

            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName('TD')[n];
                y = rows[i + 1].getElementsByTagName('TD')[n];

                if (dir == 'asc') {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if ( dir == 'desc') {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }

            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;
            } else {
                if (switchcount == 0 && dir == 'asc') {
                    dir = 'desc';
                    switching = true;
                }
            }
        }
    }

    function updateTable() {
        // Fungsi untuk memperbarui data tabel jika diperlukan
        console.log("Table updated");
    }
    </script>
</body>
</html>