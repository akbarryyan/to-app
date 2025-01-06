{{-- resources/views/components/notify-messages.blade.php --}}
@if(session()->has('notify.message'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Notyf().{{ session('notify.type', 'success') }}('{{ session('notify.message') }}');
        });
    </script>
@endif
