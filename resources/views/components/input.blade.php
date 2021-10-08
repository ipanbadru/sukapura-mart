@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-300 transition duration-200']) !!}>
