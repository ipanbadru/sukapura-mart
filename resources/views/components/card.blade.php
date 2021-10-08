<div {!! $attributes->merge(['class' => 'w-full p-8 pt-16 border shadow-lg rounded-md bg-white relative']) !!}>
    <div class="flex items-center justify-between absolute top-0 right-0 left-0 py-2 px-4 pt bg-gray-200 border rounded-tl-md rounded-tr-md bg-opacity-75 text-violet-500 text-xl font-semibold tracking-wide">
        {{ $header }}
    </div>
    {{ $slot }}
</div>