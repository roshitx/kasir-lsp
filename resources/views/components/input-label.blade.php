@props(['value', 'required' => true])

@php
    $arterix = '<span class="text-red-500">*</span>';
@endphp

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {!! $value ?? $slot !!} {!! $required ? $arterix : '' !!}
</label>
