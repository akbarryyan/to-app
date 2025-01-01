<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edmate Learning Dashboard HTML Template</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/file-upload.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plyr.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/full-calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/editor-quill.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/apexcharts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-jvectormap-2.0.5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
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
                            }, 3000);
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

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        setTimeout(function() {
                            $('#content-area').empty().html(response.html); // pastikan menggunakan .html dari JSON
                            history.pushState(null, null, url);
                            $('#loading').removeClass('active');
                            $('#content-area').removeClass('fade-out').addClass('fade-in');
                        }, 1000);
                    },
                    error: function(xhr, status, error) {
                        $('#loading').removeClass('active');
                        alert('Failed to load content');
                    }
                });
            });
        });
    </script>
</body>
</html>
