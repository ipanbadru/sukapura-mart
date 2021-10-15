
<a href="{{ $href }}" {!! $attributes->merge(['class' => "inline-flex items-center px-4 py-2 bg-$color-600 border border-transparent rounded-md font-semibold tracking-wider text-sm text-white hover:bg-$color-700 active:bg-$color-800 focus:outline-none focus:ring ring-$color-300 transition ease-in-out duration-150"]) !!}>
    {{ $slot }}
</a>