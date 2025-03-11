@extends('user.layouts.app')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold text-bgray-900 dark:text-white">Pilih Tryout</h1>
        <p class="mt-2 text-bgray-600 dark:text-bgray-50">Daftar tryout yang tersedia untuk kamu ikuti.</p>

        <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($tryouts as $tryout)
                <div class="bg-white dark:bg-darkblack-600 p-6 rounded-xl shadow">
                    <img
                        class="h-40 w-full object-cover rounded-lg mb-4"
                        src="{{ $tryout->image ? asset('storage/' . $tryout->image) : asset('user/assets/images/avatar/profile.png') }}"
                        alt="{{ $tryout->name }}"
                    />
                    <h3 class="text-lg font-bold text-bgray-900 dark:text-white">{{ $tryout->name }}</h3>
                    <p class="mt-2 text-sm text-bgray-600 dark:text-bgray-50">{{ $tryout->description }}</p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-sm font-medium text-bgray-600 dark:text-bgray-50">
                            {{ $tryout->is_paid ? 'Berbayar: Rp ' . number_format($tryout->price, 0, ',', '.') : 'Gratis' }}
                        </span>
                        <span class="text-xs text-bgray-500">
                            {{ \Carbon\Carbon::parse($tryout->start_date)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($tryout->end_date)->format('d-m-Y') }}
                        </span>
                    </div>
                    <button
                        data-tryout-id="{{ $tryout->id }}"
                        class="register-tryout mt-4 w-full rounded-lg bg-success-300 px-4 py-2 text-white font-semibold flex items-center justify-center"
                    >
                        <span class="button-text">Daftar</span>
                        <span class="loading-spinner hidden animate-spin h-5 w-5 border-2 border-t-transparent border-white rounded-full ml-2"></span>
                    </button>
                </div>
            @empty
                <p class="text-bgray-600 dark:text-bgray-50">Belum ada tryout tersedia saat ini.</p>
            @endforelse
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script>
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            timeOut: 3000,
        };

        $(document).ready(function() {
            console.log('Page loaded, jQuery ready'); // Debug 1: Cek jQuery jalan

            $('.register-tryout').on('click', function() {
                console.log('Button clicked'); // Debug 2: Cek klik ke-trigger

                const tryoutId = $(this).data('tryout-id');
                console.log('Tryout ID:', tryoutId); // Debug 3: Cek ID

                const $button = $(this);
                const $buttonText = $button.find('.button-text');
                const $loadingSpinner = $button.find('.loading-spinner');

                $buttonText.addClass('hidden');
                $loadingSpinner.removeClass('hidden');
                $button.prop('disabled', true);

                $.ajax({
                    url: '/u/tryout/' + tryoutId + '/register',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('Success:', response); // Debug 4: Cek response
                        $buttonText.removeClass('hidden');
                        $loadingSpinner.addClass('hidden');
                        $button.prop('disabled', false);
                        toastr.success(response.message);
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr); // Debug 5: Cek error
                        $buttonText.removeClass('hidden');
                        $loadingSpinner.addClass('hidden');
                        $button.prop('disabled', false);
                        let errorMsg = xhr.responseJSON?.message || 'Terjadi kesalahan';
                        toastr.error(errorMsg);
                    }
                });
            });
        });
    </script>
@endsection