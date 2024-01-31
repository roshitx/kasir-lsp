@props(['disabled' => false, 'value' => '', 'name' => ''])

<textarea name="{{ $name }}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'textarea textarea-primary bg-white']) !!}>{{ $value ? $value : '' }}</textarea>
