<div class="fixed inset-0 z-10 bg-gray-300 bg-opacity-30 flex justify-center items-center"
    x-bind:class="openModal ? '' : 'hidden'">
    <div class="bg-white shadow-xl rounded-xl relative py-1 w-11/12 md:w-9/12 lg:w-7/12 xl:w-5/12 overflow-auto" x-show="openModal"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="transform translate-y-52 opacity-80"
        x-transition:enter-end="transform translate-y-0 opacity-100"
        x-transition:leave="transition ease-in duration-500"
        x-transition:leave-start="transform translate-y-0 opacity-100"
        x-transition:leave-end="opacity-0 transform translate-y-48" @click.away="openModal=false" style="max-height: 95vh">
        <div class="flex items-center justify-between border-b pt-1 pb-2 px-4 mb-4">
            <h2 class="font-semibold text-gray-800 tracking-wide" x-text="title"></h2>
            <button class="p-2 hover:bg-gray-100 text-gray-500 rounded-full transition-color duration-300"
                @click="openModal = false"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="px-6 pb-3 w-full">
            <form action="" @submit="((e) => {
                e.preventDefault();
                loading = true;
                $wire.submited(id_kasir, nama, username, email, password, password_confirmation)
                        .then(result => {
                            loading = false;
                            password = '';
                            password_confirmation = '';
                            if(result == 'berhasil'){
                                openModal = false;
                            }
                        });
                })" id="form" novalidate>
                <input type="hidden" x-model="id_kasir">
                <!-- Name -->
                <div>
                    <x-label for="nama" :value="__('Nama')" />

                    @error('nama')
                    <x-input id="nama" class="block mt-1 w-full border-red-500" type="text" name="" x-model="nama" />
                    <span class="text-sm mt-1 text-red-600">{{ $message }}</span>
                    @else
                    <x-input id="nama" class="block mt-1 w-full" type="text" name="" x-model="nama" />
                    @enderror
                </div>

                <div class="mt-4">
                    <x-label for="username" :value="__('Username')" />

                    @error('username')
                    <x-input id="username" class="block mt-1 w-full border-red-500" type="text" name="" x-model="username" />
                    <span class="text-sm mt-1 text-red-600">{{ $message }}</span>
                    @else
                    <x-input id="username" class="block mt-1 w-full" type="text" name="" x-model="username" />
                    @enderror
                </div>
    
                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />

                    @error('email')
                        <x-input id="email" class="block mt-1 w-full border-red-500" type="email" name="" x-model="email"  />
                        <span class="text-sm mt-1 text-red-600">{{ $message }}</span>
                    @else
                        <x-input id="email" class="block mt-1 w-full" type="email" name="" x-model="email"  />
                    @enderror
                </div>
    
                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" x-text="title == 'Edit Kasir' ? 'Password (opsional)' : 'Password'"></x-label>

                        @error('password')
                            <x-input id="password" class="block mt-1 w-full border-red-500" type="password" name=""  x-model="password" autocomplete="off" />
                            <span class="text-sm mt-1 text-red-600">{{ $message }}</span>
                        @else
                            <x-input id="password" class="block mt-1 w-full" type="password" name=""  x-model="password" autocomplete="off" />
                        @enderror
                    </div>
                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-label for="password_confirmation" x-text="title == 'Edit Kasir' ? 'Confrim Password (opsional)' : 'Confrim Password'"></x-label>
                        <x-input id="password_confirmation"
                                class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation"
                                x-model="password_confirmation"
                                required />
                    </div>
    
                <div class="mt-4 flex items-end gap-3">
                    <template x-if="title == 'Edit Kasir'">
                        <x-button-green x-bind:disabled="loading">
                            <span class="mr-2" x-show="loading">
                                <x-loading w="5" h="5" />
                            </span>
                            <span x-text="title"></span>
                        </x-button-green>
                    </template>
                    <template x-if="title == 'Tambah Kasir'">
                        <x-button x-bind:disabled="loading">
                            <span class="mr-2" x-show="loading">
                                <x-loading w="5" h="5" />
                            </span>
                            <span x-text="title"></span>
                        </x-button>
                    </template>
                    <x-button type="button" color="blue-gray" @click="openModal = false">Batal</x-button>
                </div>
            </form>
        </div>
    </div>
</div>
