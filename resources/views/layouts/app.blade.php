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
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm" method="POST">
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
    </div>

    <!-- Modal Edit Kategori -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
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
    </div>

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

    <!-- Modal Tambah Pertanyaan -->
    <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addQuestionModalLabel">Add Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addQuestionForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="question_type" class="form-label">Question Type</label>
                            <select class="form-control" id="question_type" name="question_type" required>
                                <option value="text">Text</option>
                                <option value="image">Image</option>
                            </select>
                        </div>
                        <div class="mb-3 question-text-field">
                            <label for="question_text" class="form-label">Question Text</label>
                            <textarea class="form-control" id="question_text" name="question_text"></textarea>
                        </div>
                        <div class="mb-3 question-image-field d-none">
                            <label for="question_image" class="form-label">Question Image</label>
                            <input type="file" class="form-control" id="question_image" name="question_image">
                        </div>
                        <div class="mb-3">
                            <label for="option_a" class="form-label">Option A</label>
                            <input type="text" class="form-control" id="option_a" name="option_a" required>
                        </div>
                        <div class="mb-3">
                            <label for="option_b" class="form-label">Option B</label>
                            <input type="text" class="form-control" id="option_b" name="option_b" required>
                        </div>
                        <div class="mb-3">
                            <label for="option_c" class="form-label">Option C</label>
                            <input type="text" class="form-control" id="option_c" name="option_c" required>
                        </div>
                        <div class="mb-3">
                            <label for="option_d" class="form-label">Option D</label>
                            <input type="text" class="form-control" id="option_d" name="option_d" required>
                        </div>
                        <div class="mb-3">
                            <label for="correct_answer" class="form-label">Correct Answer</label>
                            <select class="form-control" id="correct_answer" name="correct_answer" required>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary" id="addQuestionButton">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Pertanyaan -->
    <div class="modal fade" id="editQuestionModal" tabindex="-1" aria-labelledby="editQuestionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editQuestionModalLabel">Edit Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editQuestionForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editQuestionId" name="id">
                        <div class="mb-3">
                            <label for="editCategoryId" class="form-label">Category</label>
                            <select class="form-control" id="editCategoryId" name="category_id" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editQuestionType" class="form-label">Question Type</label>
                            <select class="form-control" id="editQuestionType" name="question_type" required>
                                <option value="text">Text</option>
                                <option value="image">Image</option>
                            </select>
                        </div>
                        <div class="mb-3 edit-question-text-field">
                            <label for="editQuestionText" class="form-label">Question Text</label>
                            <textarea class="form-control" id="editQuestionText" name="question_text"></textarea>
                        </div>
                        <div class="mb-3 edit-question-image-field d-none">
                            <label for="editQuestionImage" class="form-label">Question Image</label>
                            <input type="file" class="form-control" id="editQuestionImage" name="question_image">
                        </div>
                        <div class="mb-3">
                            <label for="editOptionA" class="form-label">Option A</label>
                            <input type="text" class="form-control" id="editOptionA" name="option_a" required>
                        </div>
                        <div class="mb-3">
                            <label for="editOptionB" class="form-label">Option B</label>
                            <input type="text" class="form-control" id="editOptionB" name="option_b" required>
                        </div>
                        <div class="mb-3">
                            <label for="editOptionC" class="form-label">Option C</label>
                            <input type="text" class="form-control" id="editOptionC" name="option_c" required>
                        </div>
                        <div class="mb-3">
                            <label for="editOptionD" class="form-label">Option D</label>
                            <input type="text" class="form-control" id="editOptionD" name="option_d" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCorrectAnswer" class="form-label">Correct Answer</label>
                            <select class="form-control" id="editCorrectAnswer" name="correct_answer" required>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary" id="saveChangesButtonQuestion">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus Pertanyaan -->
    <div class="modal fade" id="deleteQuestionModal" tabindex="-1" aria-labelledby="deleteQuestionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteQuestionModalLabel">Delete Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this question?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="deleteQuestionButton">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Pengumuman -->
    <div class="modal fade" id="addAnnouncementModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addAnnouncementForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" checked> Active
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="addAnnouncementButton">Add Announcement</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Pengumuman -->
    <div class="modal fade" id="editAnnouncementModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editAnnouncementForm">
                    <input type="hidden" id="editAnnouncementId" name="id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="editTitle" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="editMessage" class="form-label">Message</label>
                            <textarea class="form-control" id="editMessage" name="message" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" id="editIsActive" name="is_active"> Active
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveChangesButtonAnnouncement">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteAnnouncementModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Yakin mau hapus pengumuman ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="deleteAnnouncementButton">Delete</button>
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
        
        // Tampilkan modal tambah pertanyaan
        function showAddQuestionModal() {
            $('#addQuestionModal').modal('show');
        }

        // Atur tampilan berdasarkan tipe pertanyaan
        $('#question_type').on('change', function() {
            if (this.value === 'text') {
                $('.question-text-field').removeClass('d-none');
                $('.question-image-field').addClass('d-none');
            } else {
                $('.question-text-field').addClass('d-none');
                $('.question-image-field').removeClass('d-none');
            }
        });

        // Kirim data formulir tambah pertanyaan
        $(document).on('click', '#addQuestionButton', function(event) {
            event.preventDefault();
            $('#loading').addClass('active');
            let formData = new FormData($('#addQuestionForm')[0]);

            $.ajax({
                url: '{{ route("admin.questions.store") }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {
                    console.log('Add question success:', result);
                    $('#addQuestionModal').modal('hide');
                    setTimeout(function() {
                        $('#loading').removeClass('active');
                    }, 2000); // Delay 2 detik
                    toastr.success(result.message);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    $('#loading').removeClass('active');
                    console.error('Delete tryout error:', xhr.responseText);
                    toastr.error(xhr.responseText);
                }
            });
        });

        function editQuestion(id, category_id, question_type, question_text, question_image, option_a, option_b, option_c, option_d, correct_answer) {
            $('#editQuestionId').val(id);
            $('#editCategoryId').val(category_id);
            $('#editQuestionType').val(question_type).change();
            $('#editQuestionText').val(question_text);
            $('#editOptionA').val(option_a);
            $('#editOptionB').val(option_b);
            $('#editOptionC').val(option_c);
            $('#editOptionD').val(option_d);
            $('#editCorrectAnswer').val(correct_answer);

            // Tampilkan atau sembunyikan input berdasarkan tipe pertanyaan
            if (question_type === 'text') {
                $('.edit-question-text-field').removeClass('d-none');
                $('.edit-question-image-field').addClass('d-none');
                $('#editQuestionText').val(question_text);
            } else {
                $('.edit-question-text-field').addClass('d-none');
                $('.edit-question-image-field').removeClass('d-none');
                // Tampilkan gambar jika diperlukan
                // $('#editQuestionImage').val(question_image);
            }

            $('#editQuestionModal').modal('show');
        }

        // Atur tampilan berdasarkan tipe pertanyaan ketika tipe diubah
        $('#editQuestionType').on('change', function() {
            if (this.value === 'text') {
                $('.edit-question-text-field').removeClass('d-none');
                $('.edit-question-image-field').addClass('d-none');
            } else {
                $('.edit-question-text-field').addClass('d-none');
                $('.edit-question-image-field').removeClass('d-none');
            }
        });

        // Kirim data formulir edit pertanyaan
        $(document).on('click', '#saveChangesButtonQuestion', function(event) {
            event.preventDefault();
            $('#loading').addClass('active');
            let questionId = $('#editQuestionId').val();
            let formData = new FormData($('#editQuestionForm')[0]);

            $('#loading').addClass('active');
            $.ajax({
                url: `/admin/questions/${questionId}`,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {
                    $('#editQuestionModal').modal('hide');
                    toastr.success(result.message);
                    setTimeout(function() {
                        $('#loading').removeClass('active');
                    }, 2000); // Delay 2 detik
                    location.reload();
                },
                error: function(xhr) {
                    $('#loading').removeClass('active');
                    toastr.error(xhr.responseJSON.message || 'Terjadi kesalahan saat memperbarui pertanyaan.');
                }
            });
        });

        let questionIdToDelete;

    $(document).on('click', '.delete-question-button', function(event) {
        questionIdToDelete = $(this).data('id');
        $('#deleteQuestionModal').modal('show');
    });

    $(document).on('click', '#deleteQuestionButton', function(event) {
        event.preventDefault();
        $('#loading').addClass('active');
        $.ajax({
            url: `/admin/questions/${questionIdToDelete}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                console.log('Delete question success:', result);
                $('#deleteQuestionModal').modal('hide');
                $(`#question-row-${questionIdToDelete}`).fadeOut('slow', function() {
                    $(this).remove();
                });
                setTimeout(function() {
                    $('#loading').removeClass('active');
                }, 2000); // Delay 2 detik
                toastr.success(result.message);
            },
            error: function(xhr, status, error) {
                $('#loading').removeClass('active');
                console.error('Delete question error:', xhr.responseText);
                toastr.error(xhr.responseText || 'Terjadi kesalahan saat menghapus pertanyaan.');
            }
        });
    });
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
                    toastr.success(result.message);
                    setTimeout(function() {
                        $('#loading').removeClass('active');
                    }, 2000); // Delay 2 detik
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

    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        let categoryIdToDelete;

        // Fungsi untuk menampilkan modal tambah kategori
        function showAddCategoryModal() {
            $('#addCategoryModal').modal('show');
        }

        function confirmDeleteCategory(categoryId) {
            categoryIdToDelete = categoryId;
            $('#deleteCategoryModal').modal('show');
        }


        // Fungsi untuk menampilkan modal edit kategori
        function editCategory(id, name, description, duration, tryout_id) {
            $('#editCategoryId').val(id);
            $('#editName').val(name);
            $('#editDescription').val(description);
            $('#editDuration').val(duration);
            $('#editTryoutId').val(tryout_id);
            $('#editCategoryModal').modal('show');
        }


        // AJAX untuk tambah kategori
        $(document).on('click', '#addCategoryButton', function(event) {
            event.preventDefault(); // Mencegah form submit default
            $('#loading').addClass('active'); // Menampilkan loading indicator

            let formData = new FormData($('#addCategoryForm')[0]); // Mengambil data dari form

            $.ajax({
                url: '/admin/categories', // URL endpoint untuk tambah kategori
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                data: formData,
                processData: false, // Tidak memproses data
                contentType: false, // Tidak mengatur content type
                success: function(result) {
                    console.log('Add category success:', result); // Log hasil sukses
                    $('#addCategoryModal').modal('hide'); // Sembunyikan modal
                    setTimeout(function() {
                        $('#loading').removeClass('active'); // Sembunyikan loading indicator setelah 2 detik
                    }, 2000);
                    toastr.success(result.message); // Tampilkan pesan sukses
                    location.reload(); // Reload halaman untuk menampilkan data terbaru
                },
                error: function(xhr, status, error) {
                    $('#loading').removeClass('active'); // Sembunyikan loading indicator
                    console.error('Add category error:', xhr.responseText); // Log error
                    toastr.error(xhr.responseText); // Tampilkan pesan error
                }
            });
        });

        // Kirim data formulir edit kategori
        $(document).on('click', '#saveChangesButtonCategory', function(event) {
            event.preventDefault();
            let categoryId = $('#editCategoryId').val();
            let formData = $('#editCategoryForm').serialize();

            $('#loading').addClass('active');
            $.ajax({
                url: `/admin/categories/${categoryId}`,
                type: 'PUT',
                data: formData,
                success: function(result) {
                    $('#editCategoryModal').modal('hide');
                    toastr.success(result.message);
                    // Lakukan sesuatu setelah berhasil memperbarui kategori, misalnya memuat ulang daftar kategori
                    setTimeout(function() {
                        $('#loading').removeClass('active');
                    }, 2000); // Delay 2 detik
                    location.reload();
                },
                error: function(xhr) {
                    $('#loading').removeClass('active');
                    toastr.error(xhr.responseJSON.message || 'Terjadi kesalahan saat memperbarui kategori.');
                }
            });
        });


        // AJAX untuk hapus kategori
        $(document).on('click', '.delete-category-button', function(event) {
            categoryIdToDelete = $(this).data('id');
            $('#deleteCategoryModal').modal('show');
        });

        $(document).on('click', '#deleteCategoryButton', function(event) {
            event.preventDefault();
            $('#loading').addClass('active');
            $.ajax({
                url: `/admin/categories/${categoryIdToDelete}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    console.log('Delete category success:', result);
                    $('#deleteCategoryModal').modal('hide');
                    $(`#category-row-${categoryIdToDelete}`).fadeOut('slow', function() {
                        $(this).remove();
                    });
                    setTimeout(function() {
                        $('#loading').removeClass('active');
                    }, 2000); // Delay 2 detik
                    toastr.success(result.message);
                },
                error: function(xhr, status, error) {
                    $('#loading').removeClass('active');
                    console.error('Delete category error:', xhr.responseText);
                    toastr.error(xhr.responseText || 'Terjadi kesalahan saat menghapus kategori.');
                }
            });
        });

        // Fungsi untuk pencarian
        document.getElementById('searchInput').addEventListener('keyup', function() {
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById('searchInput');
            filter = input.value.toUpperCase();
            table = document.getElementById('categoryTable');
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
            table = document.getElementById('categoryTable');
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

        let announcementIdToDelete;
        let announcementIdToEdit;

        // Fungsi untuk menampilkan modal konfirmasi hapus
        function confirmDelete(id) {
            announcementIdToDelete = id;
            $('#deleteAnnouncementModal').modal('show');
        }

        // Fungsi untuk menampilkan modal edit
        function editAnnouncement(id, title, message, isActive) {
            announcementIdToEdit = id;
            $('#editAnnouncementId').val(id);
            $('#editTitle').val(title);
            $('#editMessage').val(message);
            $('#editIsActive').prop('checked', isActive == 1);
            $('#editAnnouncementModal').modal('show');
        }

        // Fungsi untuk menampilkan modal tambah pengumuman
        function showAddAnnouncementModal() {
            $('#addAnnouncementForm')[0].reset();
            $('#addAnnouncementModal').modal('show');
        }

        // Fungsi untuk menghapus pengumuman
        $(document).on('click', '#deleteAnnouncementButton', function(event) {
            event.preventDefault();
            $('#loading').addClass('active');
            $.ajax({
                url: `/admin/announcements/${announcementIdToDelete}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    console.log('Delete announcement success:', result);
                    $('#deleteAnnouncementModal').modal('hide');
                    $(`#announcement-row-${announcementIdToDelete}`).fadeOut('slow', function() {
                        $(this).remove();
                    });
                    setTimeout(function() {
                        $('#loading').removeClass('active');
                    }, 2000); // Delay 2 detik
                    toastr.success(result.message);
                },
                error: function(xhr, status, error) {
                    $('#loading').removeClass('active');
                    console.error('Delete announcement error:', xhr.responseText);
                    toastr.error(xhr.responseText);
                }
            });
        });

        // Fungsi untuk menyimpan perubahan pengumuman
        $(document).on('click', '#saveChangesButtonAnnouncement', function(event) {
            event.preventDefault();
            $('#loading').addClass('active');

            let formData = new FormData($('#editAnnouncementForm')[0]);
            formData.set('is_active', $('#editIsActive').is(':checked') ? 1 : 0);

            $.ajax({
                url: `/admin/announcements/${announcementIdToEdit}`,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-HTTP-Method-Override': 'PUT'
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                    console.log('Update announcement success:', result);
                    $('#editAnnouncementModal').modal('hide');
                    setTimeout(function() {
                        $('#loading').removeClass('active');
                    }, 2000); // Delay 2 detik
                    toastr.success(result.message);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    $('#loading').removeClass('active');
                    console.error('Update announcement error:', xhr.responseText);
                    toastr.error(xhr.responseText);
                }
            });
        });

        // Fungsi untuk menambah pengumuman
        $(document).on('click', '#addAnnouncementButton', function(event) {
            event.preventDefault();
            $('#loading').addClass('active');

            let formData = new FormData($('#addAnnouncementForm')[0]);
            formData.set('is_active', $('#is_active').is(':checked'));

            $.ajax({
                url: `/admin/announcements`,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                    console.log('Add announcement success:', result);
                    $('#addAnnouncementModal').modal('hide');
                    setTimeout(function() {
                        $('#loading').removeClass('active');
                    }, 2000); // Delay 2 detik
                    toastr.success(result.message);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    $('#loading').removeClass('active');
                    console.error('Add announcement error:', xhr.responseText);
                    toastr.error(xhr.responseText);
                }
            });
        });

        // Fungsi untuk toggle status pengumuman
        function toggleAnnouncement(id) {
            $('#loading').addClass('active');
            $.ajax({
                url: `/admin/announcements/${id}/toggle`,
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    console.log('Toggle announcement success:', result);
                    toastr.success(result.message);
                    setTimeout(function() {
                        $('#loading').removeClass('active');
                    }, 2000); // Delay 2 detik
                    location.reload();
                },
                error: function(xhr, status, error) {
                    $('#loading').removeClass('active');
                    console.error('Toggle announcement error:', xhr.responseText);
                    toastr.error(xhr.responseText);
                }
            });
        }

        // Fungsi untuk pencarian
        document.getElementById('searchInput').addEventListener('keyup', function() {
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById('searchInput');
            filter = input.value.toUpperCase();
            table = document.getElementById('announcementTable');
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
            table = document.getElementById('announcementTable');
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
</body>
</html>