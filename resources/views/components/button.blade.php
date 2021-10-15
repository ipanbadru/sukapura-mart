@props(['color' => 'violet'])

<button {!! $attributes->merge(['type' => 'submit', 'class' => "inline-flex items-center px-4 py-2 bg-$color-700 border border-transparent rounded-md font-semibold text-sm text-white tracking-widest hover:bg-$color-800 active:bg-gray-700 focus:outline-none focus:border-$color-800 focus:ring ring-$color-300 disabled:opacity-25 transition ease-in-out duration-150"]) !!}>
    {{ $slot }}
</button>
