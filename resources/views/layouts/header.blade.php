<!-- Desktop Header -->
<header class="w-full items-center bg-white border-b shadow py-2 px-6 hidden md:flex justify-between z-10">
    <div class="w-1/2 flex text-xl text-gray-500 font-thin" x-data="{date: new Date(), bulan : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']}" x-init="setInterval(() => date = new Date(), 1000)">
        <div class="flex space-x-2 font-normal text-gray-600">
            <span x-text="date.getDate()"></span> 
            <span x-text="bulan[date.getMonth()]"></span>
            <span x-text="date.getFullYear()"></span>
        </div>
        <span class="mx-3">|</span>
        <div class="flex">
            <span x-text="('0' + date.getHours()).slice(-2)"></span>:
            <span x-text="('0' + date.getMinutes()).slice(-2)"></span>:
            <span x-text="('0' + date.getSeconds()).slice(-2)"></span> 
            <span class="ml-2" x-text="date.getHours < 12 ? 'AM' : 'PM'"></span>
        </div>
    </div>
    <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
        <button @click="isOpen = !isOpen" class="realtive text-lg text-gray-600 hover:text-gray-700 py-3 flex items-center">
            {{ Auth::user()->nama }}
            <svg class="fill-current h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </button>
        <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
        <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg mt-16 text-center overflow-hidden">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="block w-full px-6 py-4 text-left hover:bg-blue-gray-100">
                    <span class="text-left">Logout</span>
                </button>
            </form>
        </div>
    </div>
</header>

{{-- <!-- Mobile Header & Nav -->
<header x-data="{ isOpen: false }" class="w-full md:hidden">
    <div class="flex items-center bg-violet-700 justify-between py-5 px-6">
        <h2 class="flex items-center text-2xl text-white"><img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-10 mr-2">{{ Auth::user()->nama }}</h2>
        <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
            <span x-show="!isOpen"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg></span>
            <span x-show="isOpen"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg></span>
        </button>
    </div>
    <!-- Dropdown Nav -->
    <nav x-show="isOpen" class="flex z-0 bg-white flex-col">
        @foreach ($nav as $item)
        <a href="{{ route($item[1]) }}" class="flex items-center group py-4 pl-5 border-b {{ request()->segment(1) == strtolower($item[0]) ? 'bg-blue-gray-100'  : 'hover:bg-gray-100'}} font-semibold">
            <span class="{{ request()->segment(1) == strtolower($item[0]) ? 'text-violet-800' :'text-gray-800 group-hover:text-black' }} text-xl font-bold">
                {!! $item[2] !!}
            </span>
            <span class="{{ request()->segment(1) == strtolower($item[0]) ? 'text-violet-700' :'text-gray-600 group-hover:text-gray-700' }} ml-3">   
                {{ $item[0] }}
            </span>
        </a>
        @endforeach
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="flex items-center group py-4 pl-5 border-b hover:bg-gray-100 font-semibold">
                <span class="text-gray-800 group-hover:text-black text-xl font-bold"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg></span>
                <span class="text-gray-600 group-hover:text-gray-700 ml-3">
                    Logout
                </span>
            </button>
        </form>
    </nav>
</header> --}}

