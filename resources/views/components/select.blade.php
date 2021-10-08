<select {!! $attributes->merge(['class' => 'py-2 w-full px-4 outline-none focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-300 border border-gray-300 rounded-md shadow']) !!}>
    {{ $slot }}
</select>