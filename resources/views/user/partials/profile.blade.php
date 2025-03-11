<main class="w-full px-6 pb-6 pt-[100px] sm:pt-[156px] xl:px-[48px] xl:pb-[48px]">
    <div class="grid grid-cols-1 rounded-xl bg-white dark:bg-darkblack-600 xl:grid-cols-12">
        <!-- Sidebar -->
        <aside class="col-span-3 border-r border-bgray-200 dark:border-darkblack-400">
            <div class="px-4 py-6">
                <div class="tab active flex gap-x-4 rounded-lg p-4 transition-all" data-tab="tab1">
                    <div class="tab-icon inline-flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-bgray-100 transition-all dark:bg-darkblack-500">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <ellipse cx="12" cy="17.5" rx="7" ry="3.5" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                            <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="1.5 stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-bgray-900 dark:text-white">Personal Information</h4>
                        <p class="mt-0.5 text-sm font-medium text-bgray-700 dark:text-darkblack-300">Lengkapi data diri kamu</p>
                    </div>
                </div>
                <div class="tab flex gap-x-4 rounded-lg p-4 transition-all">
                    <form action="{{ route('user.logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="flex gap-x-4 items-center w-full text-left">
                            <div class="tab-icon inline-flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-bgray-100 transition-all dark:bg-darkblack-500">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9M16 17L21 12M21 12L16 7M21 12H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-base font-bold text-bgray-900 dark:text-white">Logout</h4>
                                <p class="mt-0.5 text-sm font-medium text-bgray-700 dark:text-darkblack-300">Keluar dari akun</p>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Tab Content -->
        <div class="tab-content col-span-9 px-10 py-8">
            <div id="tab1" class="tab-pane active">
                <div class="flex grid-cols-12 flex-col-reverse gap-12 xl:grid 2xl:flex-row">
                    <div class="xl:col-span-7 2xl:col-span-8">
                        <h3 class="border-b border-bgray-200 pb-5 text-2xl font-bold text-bgray-900 dark:border-darkblack-400 dark:text-white">
                            Personal Information
                        </h3>
                        <div class="mt-8">
                            <form id="profileForm" action="{{ route('user.profile') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="grid grid-cols-1 gap-6 2xl:grid-cols-2">
                                    <div class="flex flex-col gap-2">
                                        <label for="name" class="text-base font-medium text-bgray-600 dark:text-bgray-50">Nama</label>
                                        <input type="text" id="name" value="{{ $user->name }}" class="h-14 rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white" disabled />
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="email" class="text-base font-medium text-bgray-600 dark:text-bgray-50">Email</label>
                                        <input type="email" id="email" value="{{ $user->email }}" class="h-14 rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white" disabled />
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="sekolah_asal" class="text-base font-medium text-bgray-600 dark:text-bgray-50">Sekolah Asal</label>
                                        <input type="text" id="sekolah_asal" name="sekolah_asal" value="{{ $user->sekolah_asal ?? '' }}" class="h-14 rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white" placeholder="Masukkan sekolah asal" required />
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="jurusan_tujuan" class="text-base font-medium text-bgray-600 dark:text-bgray-50">Jurusan Tujuan</label>
                                        <input type="text" id="jurusan_tujuan" name="jurusan_tujuan" value="{{ $user->jurusan_tujuan ?? '' }}" class="h-14 rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white" placeholder="Masukkan jurusan tujuan" required />
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="password" class="text-base font-medium text-bgray-600 dark:text-bgray-50">Password Baru (Opsional)</label>
                                        <input type="password" id="password" name="password" class="h-14 rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white" placeholder="Masukkan password baru" />
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="password_confirmation" class="text-base font-medium text-bgray-600 dark:text-bgray-50">Konfirmasi Password</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="h-14 rounded-lg border-0 bg-bgray-50 p-4 focus:border focus:border-success-300 focus:ring-0 dark:bg-darkblack-500 dark:text-white" placeholder="Konfirmasi password" />
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="avatar" class="text-base font-medium text-bgray-600 dark:text-bgray-50">Avatar (Opsional)</label>
                                        <input type="file" id="avatar" name="avatar" class="h-14 rounded-lg border-0 bg-bgray-50 p-4 text-bgray-600 dark:bg-darkblack-500 dark:text-white" accept="image/*" />
                                    </div>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" id="saveButton" class="mt-10 rounded-lg bg-success-300 px-4 py-3.5 font-semibold text-white flex items-center justify-center">
                                        <span id="buttonText">Save Profile</span>
                                        <span id="loadingSpinner" class="hidden animate-spin h-5 w-5 border-2 border-t-transparent border-white rounded-full ml-2"></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="xl:col-span-5 2xl:col-span-4 2xl:mt-24">
                        <header class="mb-8">
                            <h4 class="mb-2 text-lg font-bold text-bgray-800 dark:text-white">Update Profile</h4>
                            <p class="mb-4 text-bgray-500">Lengkapi data untuk memulai tryout.</p>
                            <div class="relative m-auto h-40 w-40 text-center">
                                <img id="avatarPreview" src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('user/assets/images/avatar/profile.png') }}" alt="Profile" class="object-cover w-full h-full rounded-full" />
                            </div>
                        </header>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Scripts -->
<script src="{{ asset('user/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('user/assets/js/main.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: 'toast-top-right',
        timeOut: 3000,
    };

    $(document).ready(function() {
        // Preview avatar sebelum upload
        $('#avatar').on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#avatarPreview').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });

        $('#profileForm').on('submit', function(e) {
            e.preventDefault();

            // Tampilkan animasi loading
            $('#buttonText').addClass('hidden');
            $('#loadingSpinner').removeClass('hidden');
            $('#saveButton').prop('disabled', true);

            // Kirim data dengan FormData
            let formData = new FormData(this);

            $.ajax({
                url: '{{ route("user.profile") }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    // Sembunyikan loading
                    $('#buttonText').removeClass('hidden');
                    $('#loadingSpinner').addClass('hidden');
                    $('#saveButton').prop('disabled', false);

                    // Toastr sukses
                    toastr.success(response.message);

                    // Update avatar di UI kalau ada
                    if (response.avatar) {
                        $('#avatarPreview').attr('src', '{{ asset("storage/") }}/' + response.avatar);
                    }
                },
                error: function(xhr) {
                    // Sembunyikan loading
                    $('#buttonText').removeClass('hidden');
                    $('#loadingSpinner').addClass('hidden');
                    $('#saveButton').prop('disabled', false);

                    // Toastr error dengan detail
                    let errorMsg = xhr.responseJSON.message || 'Terjadi kesalahan';
                    if (xhr.responseJSON.errors) {
                        errorMsg += ': ' + Object.values(xhr.responseJSON.errors).join(', ');
                    }
                    toastr.error(errorMsg);
                }
            });
        });
    });
</script>