<aside class="relative bg-violet-600 h-screen w-64 hidden md:block">
    <div class="flex flex-col items-center mt-5 mb-3">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-28 mx-auto">
        <h1
            class="bg-white shadow-xl text-violet-600 px-4 py-2 tracking-widest text-xl text-center font-semibold rounded-md mt-2">
            Sukapura Mart</h1>
    </div>
    <nav class="text-base font-semibold pl-2 pt-1">
        @foreach ($nav as $item)
        <a href="{{ route($item[1]) }}"
            class="flex group items-center {{ request()->segment(1) == strtolower($item[0]) ? 'text-gray-600 rounded-tl-3xl rounded-bl-3xl bg-blue-gray-50' : 'text-gray-200 hover:text-gray-100' }} text-sm py-4 pl-4 relative">
            @if (request()->segment(1) == strtolower($item[0]))
            <div class="absolute w-full h-5 bg-blue-gray-50 -top-5 left-0"></div>
            <div class="absolute w-full h-5 bg-violet-600 left-0 -top-5 rounded-br-xl"></div>
            <div class="absolute w-full h-5 bg-blue-gray-50 -bottom-5 left-0"></div>
            <div class="absolute w-full h-5 bg-violet-600 left-0 -bottom-5 rounded-tr-xl"></div>
            @endif
            <div
                class="font-bold {{ request()->segment(1) == strtolower($item[0]) ? 'text-black' : 'text-gray-100 group-hover:text-white' }}">
                {!! $item[2] !!}
            </div>
            <div class="ml-4">
                {{ $item[0] }}
            </div>
        </a>
        @endforeach
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="flex group items-center text-gray-200 hover:text-gray-100 font-semibold text-sm py-4 pl-4 relative">
                <div class="font-bold text-gray-100 group-hover:text-white"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg></div>
                <div class="ml-4">
                    Logout
                </div>
            </button>
        </form>
    </nav>
</aside>
