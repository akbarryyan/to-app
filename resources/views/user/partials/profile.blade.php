<main class="w-full px-6 pb-6 pt-[100px] sm:pt-[156px] xl:px-[48px] xl:pb-[48px]">
    <div class="grid grid-cols-1 rounded-xl bg-white dark:bg-darkblack-600 xl:grid-cols-12">
        <!-- Sidebar -->
        <aside class="col-span-3 border-r border-bgray-200 dark:border-darkblack-400">
            <div class="px-4 py-6">
                <div class="tab active flex gap-x-4 rounded-lg p-4 transition-all" data-tab="tab1">
                    <div class="tab-icon inline-flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-bgray-100 transition-all dark:bg-darkblack-500">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <ellipse cx="12" cy="17.5" rx="7" ry="3.5" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                            <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-bgray-900 dark:text-white">Personal Information</h4>
                        <p class="mt-0.5 text-sm font-medium text-bgray-700 dark:text-darkblack-300">Lengkapi data diri kamu</p>
                    </div>
                </div>
                <!-- Tab Logout -->
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
                            <form id="profileForm" action="{{ route('user.profile') }}" method="POST">
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
                                <img src="{{ asset('user/assets/images/avatar/profile.png') }}" alt="Profile" />
                                <button class="absolute bottom-1 right-4">
                                    <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="14.2414" cy="14.2414" r="14.2414" fill="#22C55E" />
                                        <path d="M14.6994 10.2363C15.7798 11.3167 16.8435 12.3803 17.9171 13.454C17.7837 13.584 17.6403 13.7174 17.5036 13.8574C15.5497 15.8114 13.5924 17.7653 11.6385 19.7192C11.5118 19.8459 11.3884 19.9726 11.2617 20.0927C11.2317 20.1193 11.185 20.1427 11.145 20.1427C10.1281 20.146 9.11108 20.1427 8.0941 20.146C8.02408 20.146 8.01074 20.1193 8.01074 20.0593C8.01074 19.049 8.01074 18.0354 8.01408 17.0251C8.01408 16.9784 8.03742 16.9217 8.06743 16.8917C9.26779 15.688 10.4682 14.4876 11.6685 13.2873C12.6655 12.2903 13.6591 11.2967 14.6561 10.2997C14.6761 10.2797 14.6861 10.253 14.6994 10.2363Z" fill="white" />
                                        <path d="M18.6467 12.7197C17.573 11.646 16.506 10.579 15.4424 9.51537C15.6324 9.31864 15.8292 9.11858 16.0259 8.91852C16.256 8.68845 16.4894 8.45838 16.7228 8.22831C17.0162 7.93822 17.4197 7.93822 17.7097 8.22831C18.4466 8.9552 19.1802 9.68542 19.9171 10.4123C20.2038 10.6957 20.2138 11.0992 19.9371 11.3859C19.5136 11.8261 19.0868 12.2629 18.6634 12.703C18.66 12.7097 18.65 12.7163 18.6467 12.7197Z" fill="white" />
                                    </svg>
                                </button>
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
        $('#profileForm').on('submit', function(e) {
            e.preventDefault();

            // Tampilkan animasi loading Tailwind
            $('#buttonText').addClass('hidden');
            $('#loadingSpinner').removeClass('hidden');
            $('#saveButton').prop('disabled', true);

            $.ajax({
                url: '{{ route("user.profile") }}',
                method: 'POST',
                data: $(this).serialize(),
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    // Sembunyikan loading
                    $('#buttonText').removeClass('hidden');
                    $('#loadingSpinner').addClass('hidden');
                    $('#saveButton').prop('disabled', false);

                    // Toastr sukses, tanpa redirect
                    toastr.success(response.message);
                },
                error: function(xhr) {
                    // Sembunyikan loading
                    $('#buttonText').removeClass('hidden');
                    $('#loadingSpinner').addClass('hidden');
                    $('#saveButton').prop('disabled', false);

                    // Toastr error
                    toastr.error(xhr.responseJSON.message);
                }
            });
        });

        // Tab switching (opsional)
        $('.tab').on('click', function() {
            $('.tab').removeClass('active');
            $(this).addClass('active');
            $('.tab-pane').removeClass('active');
            $('#' + $(this).data('tab')).addClass('active');
        });
    });
</script>