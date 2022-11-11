@php
    $keys = ['error', 'info', 'success', 'warning'];
@endphp

@foreach ($keys as $key)
@if (session()->has($key))

<script>
    iziToast.{{ $key }}({
message: '{!! session($key) !!}',
position: 'topRight'
});
    </script>


@endif

@endforeach

