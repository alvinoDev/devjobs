@php
    $classes = "text-sm text-gray-600 hover:text-gray-900 rounded-md focus:text-green-500";
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>