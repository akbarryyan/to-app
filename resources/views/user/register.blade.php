<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" /> <!-- Tambah CSRF -->
    <title>Sign Up - Tryout</title>
    <link rel="stylesheet" href="{{ asset('user/assets/css/output.css') }}" />
    <link rel="stylesheet" href="{{ asset('user/assets/css/style.css') }}" />
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
              <h2 class="text-bgray-900 dark:text-white text-4xl font-semibold font-poppins mb-2">Sign up for an account</h2>
              <p class="font-urbanis text-base font-medium text-bgray-600 dark:text-darkblack-300">Prepare for your future with us</p>
            </header>

            <!-- Google & Apple Button (opsional, bisa dihapus kalau nggak dipake) -->
            <div class="flex flex-col md:flex-row gap-4">
              <a href="#" class="inline-flex justify-center items-center gap-x-2 border border-bgray-300 dark:border-darkblack-400 rounded-lg px-6 py-4 text-base text-bgray-900 dark:text-white font-medium">
                <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <!-- SVG Google -->
                </svg>
                <span>Sign In with Google</span>
              </a>
              <a href="#" class="inline-flex justify-center items-center gap-x-2 border border-bgray-300 dark:border-darkblack-400 rounded-lg px-6 py-4 text-base text-bgray-900 dark:text-white font-medium">
                <svg class="fill-bgray-900 dark:fill-white" width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <!-- SVG Apple -->
                </svg>
                <span>Sign In with Apple</span>
              </a>
            </div>

            <div class="relative mt-6 mb-5">
              <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300 dark:border-darkblack-400"></div>
              </div>
              <div class="relative flex justify-center text-sm">
                <span class="bg-white dark:bg-darkblack-500 px-2 text-base text-bgray-600">Or continue with</span>
              </div>
            </div>

            <!-- Form -->
            <form id="registerForm" action="{{ route('user.register') }}" method="POST">
              @csrf
              <div class="mb-4">
                <input type="text" name="name" id="name" class="text-bgray-800 dark:text-white dark:bg-darkblack-500 dark:border-darkblack-400 text-base border border-bgray-300 h-14 w-full focus:border-success-300 focus:ring-0 rounded-lg px-4 py-3.5 placeholder:text-bgray-500 placeholder:text-base" placeholder="Nama lengkap" required />
              </div>
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
              <div class="mb-6 relative">
                <input type="password" name="password_confirmation" id="password_confirmation" class="text-bgray-800 dark:text-white dark:bg-darkblack-500 dark:border-darkblack-400 text-base border border-bgray-300 h-14 w-full focus:border-success-300 focus:ring-0 rounded-lg px-4 py-3.5 placeholder:text-bgray-500 placeholder:text-base" placeholder="Confirm Password" required />
                <button type="button" class="absolute top-4 right-4 bottom-4 toggle-password">
                  <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- SVG Eye -->
                  </svg>
                </button>
              </div>
              <div class="flex justify-between mb-7">
                <div class="flex items-center gap-x-3">
                  <input type="checkbox" class="w-5 h-5 focus:ring-transparent rounded-md border border-bgray-300 focus:accent-success-300 text-success-300 dark:bg-transparent dark:border-darkblack-400" name="remember" id="remember" />
                  <label for="remember" class="text-bgray-600 dark:text-bgray-50 text-base">By creating an account, you agreeing to our <span class="text-bgray-900 dark:text-white">Privacy Policy</span>, and <span class="text-bgray-900 dark:text-white">Electronics Communication Policy</span>.</label>
                </div>
              </div>
              <button type="submit" class="py-3.5 flex items-center justify-center text-white font-bold bg-success-300 hover:bg-success-400 transition-all rounded-lg w-full">Sign Up</button>
            </form>

            <!-- Form Bottom -->
            <p class="text-center text-bgray-900 dark:text-bgray-50 text-base font-medium pt-7">
              Already have an account? <a href="{{ route('user.login') }}" class="font-semibold underline">Sign In</a>
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
            <img src="{{ asset('user/assets/images/illustration/signup.svg') }}" alt="" />
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
    <script>
        $('#registerForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route("user.register") }}',
                method: 'POST',
                data: $(this).serialize(),
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    alert(response.message);
                    window.location.href = '{{ route("user.login") }}';
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message);
                }
            });
        });

        // Toggle password visibility (opsional, sesuain sama template)
        $('.toggle-password').on('click', function() {
            let input = $(this).siblings('input');
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
            } else {
                input.attr('type', 'password');
            }
        });
    </script>
  </body>
</html>