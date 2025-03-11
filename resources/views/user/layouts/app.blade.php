<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Dashboard - Pintu University</title>
    <link rel="stylesheet" href="{{ asset('user/assets/css/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('user/assets/css/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('user/assets/css/flatpickr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('user/assets/css/output.css') }}" />
    <link rel="stylesheet" href="{{ asset('user/assets/css/style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    @include('user.layouts.header')
    @include('user.layouts.sidebar')
    @include('user.layouts.topbar')
    <div id="content-area">
        @yield('content')
    </div>
    @include('user.layouts.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>