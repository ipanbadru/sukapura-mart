<div class="min-h-screen max-w-full flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    <div class="flex justify-center">
        {{ $logo }}
    </div>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-xl sm:rounded-xl">
        <div class="pb-5 text-center text-2xl font-semibold text-violet-400">
            <h2>Welcome Back !</h2>
        </div>
        {{ $slot }}
    </div>
</div>
