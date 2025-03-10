<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Sign In - Tryout</title>
    <link rel="stylesheet" href="{{ asset('user/assets/css/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('user/assets/css/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('user/assets/css/output.css') }}" />
    <link rel="stylesheet" href="{{ asset('user/assets/css/style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  </head>
  <body>
    <section class="bg-white dark:bg-darkblack-500">
      <div class="flex flex-col lg:flex-row justify-between min-h-screen">
        <!-- Left -->
        <div class="lg:w-1/2 px-5 xl:pl-12 pt-10">
          <header>
            <a href="{{ route('welcome') }}">
              <img src="{{ asset('user/assets/images/logo/logo-color.svg') }}" class="block dark:hidden" alt="Logo" />
              <img src="{{ asset('user/assets/images/logo/logo-white.svg') }}" class="hidden dark:block" alt="Logo" />
            </a>
          </header>

          <div class="max-w-[460px] m-auto pt-24 pb-16">
            <header class="text-center mb-8">
              <h2 class="text-bgray-900 dark:text-white text-4xl font-semibold font-poppins mb-2">Sign in to your account</h2>
              <p class="font-urbanis text-base font-medium text-bgray-600 dark:text-darkblack-300">Welcome back! Let's get started.</p>
            </header>

            <!-- Form -->
            <form id="loginForm" action="{{ route('user.login') }}" method="POST">
              @csrf
              <div class="mb-4">
                <input type="email" name="email" id="email" class="text-bgray-800 dark:text-white dark:bg-darkblack-500 dark:border-darkblack-400 text-base border border-bgray-300 h-14 w-full focus:border-success-300 focus:ring-0 rounded-lg px-4 py-3.5 placeholder:text-bgray-500 placeholder:text-base" placeholder="Email" required />
              </div>
              <div class="mb-6 relative">
                <input type="password" name="password" id="password" class="text-bgray-800 dark:text-white dark:bg-darkblack-500 dark:border-darkblack-400 text-base border border-bgray-300 h-14 w-full focus:border-success-300 focus:ring-0 rounded-lg px-4 py-3.5 placeholder:text-bgray-500 placeholder:text-base" placeholder="Password" required />
                <button type="button" class="absolute top-4 right-4 bottom-4 toggle-password">
                  <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- SVG Eye -->
                  </svg>
                </button>
              </div>
              <div class="flex justify-between mb-7">
                <div class="flex items-center gap-x-3">
                  <input type="checkbox" class="w-5 h-5 focus:ring-transparent rounded-md border border-bgray-300 focus:accent-success-300 text-success-300 dark:bg-transparent dark:border-darkblack-400" name="remember" id="remember" />
                  <label for="remember" class="text-bgray-600 dark:text-bgray-50 text-base">Remember me</label>
                </div>
                <a href="#" class="text-bgray-900 dark:text-white text-base font-medium">Forgot password?</a>
              </div>
              <button type="submit" id="loginButton" class="py-3.5 flex items-center justify-center text-white font-bold bg-success-300 hover:bg-success-400 transition-all rounded-lg w-full">
                <span id="buttonText">Sign In</span>
                <span id="loadingSpinner" class="hidden animate-spin h-5 w-5 border-2 border-t-transparent border-white rounded-full ml-2"></span>
              </button>
            </form>

            <p class="text-center text-bgray-900 dark:text-bgray-50 text-base font-medium pt-7">
              Don’t have an account? <a href="{{ route('user.register') }}" class="font-semibold underline">Sign Up</a>
            </p>
            <nav class="flex items-center justify-center flex-wrap gap-x-11 pt-24">
              <a href="#" class="text-sm text-bgray-700 dark:text-bgray-50">Terms & Condition</a>
              <a href="#" class="text-sm text-bgray-700 dark:text-bgray-50">Privacy Policy</a>
              <a href="#" class="text-sm text-bgray-700 dark:text-bgray-50">Help</a>
              <a href="#" class="text-sm text-bgray-700 dark:text-bgray-50">English</a>
            </nav>
            <p class="text-bgray-600 dark:text-darkblack-300 text-center text-sm mt-6">© 2025 Tryout. All Rights Reserved.</p>
          </div>
        </div>

        <!-- Right -->
        <div class="lg:w-1/2 lg:block hidden bg-[#F6FAFF] dark:bg-darkblack-600 p-20 relative">
          <ul>
            <li class="absolute top-10 left-8"><img src="{{ asset('user/assets/images/shapes/square.svg') }}" alt="" /></li>
            <li class="absolute right-12 top-14"><img src="{{ asset('user/assets/images/shapes/vline.svg') }}" alt="" /></li>
            <li class="absolute bottom-7 left-8"><img src="{{ asset('user/assets/images/shapes/dotted.svg') }}" alt="" /></li>
          </ul>
          <div class="mb-10">
            <img src="{{ asset('user/assets/images/illustration/signup.svg') }}" alt="" /> <!-- Ganti kalau ada illustrasi login -->
          </div>
          <div>
            <div class="text-center max-w-lg px-1.5 m-auto">
              <h3 class="text-bgray-900 dark:text-white font-semibold font-popins text-4xl mb-4">Speedy, Easy and Fast</h3>
              <p class="text-bgray-600 dark:text-darkblack-300 text-sm font-medium">Tryout helps you prepare for university entrance exams with ease. Get started today and aim for your dream campus!</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Scripts -->
    <script src="{{ asset('user/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            timeOut: 3000,
        };

        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();

                // Tampilkan animasi loading
                $('#buttonText').addClass('hidden');
                $('#loadingSpinner').removeClass('hidden');
                $('#loginButton').prop('disabled', true);

                $.ajax({
                    url: '{{ route("user.login") }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(response) {
                        // Sembunyikan loading
                        $('#buttonText').removeClass('hidden');
                        $('#loadingSpinner').addClass('hidden');
                        $('#loginButton').prop('disabled', false);

                        // Toastr sukses
                        toastr.success(response.message);

                        setTimeout(() => {
                            window.location.href = '/u/dashboard'; // Redirect ke dashboard setelah 3 detik
                        }, 3000); // 3 detik
                    },
                    error: function(xhr) {
                        // Sembunyikan loading
                        $('#buttonText').removeClass('hidden');
                        $('#loadingSpinner').addClass('hidden');
                        $('#loginButton').prop('disabled', false);

                        // Toastr error
                        toastr.error(xhr.responseJSON.message);
                    }
                });
            });

            // Toggle password visibility
            $('.toggle-password').on('click', function() {
                let input = $(this).siblings('input');
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                } else {
                    input.attr('type', 'password');
                }
            });
        });
    </script>
  </body>
</html>