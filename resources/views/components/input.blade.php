@props(['disabled' => false, 'border' => ''])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border border-gray-300 focus:outline-none focus:border-violet-400 focus:ring focus:ring-violet-500 focus:ring-opacity-30 transition duration-200']) !!}>
