<div class="fixed inset-0 z-10 bg-gray-300 bg-opacity-30 flex justify-center items-center"
    x-bind:class="openModal ? '' : 'hidden'">
    <div class="bg-white shadow-xl rounded-xl relative py-1 xl:w-5/12" x-show="openModal"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="transform translate-y-52 opacity-80"
        x-transition:enter-end="transform translate-y-0 opacity-100"
        x-transition:leave="transition ease-in duration-500"
        x-transition:leave-start="transform translate-y-0 opacity-100"
        x-transition:leave-end="opacity-0 transform translate-y-48" @click.away="openModal=false">
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
            <div>
                <form @submit="((e) => {
                    e.preventDefault();
                    loading = true;
                    $wire.submited(id_pelanggan, nik, nama_pelanggan, no_hp)
                            .then(result => {
                                loading = false;
                                if(result == 'berhasil'){
                                    openModal = false;
                                }
                            });
                    })" id="form" novalidate>
                    @csrf
                    <div>
                        <x-label for="nik" :value="__('Nik')" />
                        @error('nik')
                        <x-input id="nik" class="block mt-1 w-full border-red-500" type="text" name="nik" x-model="nik" />
                        <span class="text-sm mt-1 text-red-600">{{ $message }}</span>
                        @else
                        <x-input id="nik" class="block mt-1 w-full" type="text" name="nik" x-model="nik" />
                        @enderror
                    </div>

                    <div class="mt-4">
                        <x-label for="nama_pelanggan" :value="__('Nama Pelanggan')" />
                        @error('nama_pelanggan')
                        <x-input id="nama_pelanggan" class="block mt-1 w-full border-red-500" type="text" name="nama_pelanggan" x-model="nama_pelanggan" />
                        <span class="text-sm mt-1 text-red-600">{{ $message }}</span>
                        @else
                        <x-input id="nama_pelanggan" class="block mt-1 w-full" type="text" name="nama_pelanggan" x-model="nama_pelanggan" />
                        @enderror
                    </div>
                    <div class="mt-4">
                        <x-label for="no_hp" :value="__('No Hp')" />
                        @error('no_hp')
                        <x-input id="no_hp" class="block mt-1 w-full border-red-500" type="text" name="no_hp" x-model="no_hp" />
                        <span class="text-sm mt-1 text-red-600">{{ $message }}</span>
                        @else
                        <x-input id="no_hp" class="block mt-1 w-full" type="text" name="no_hp" x-model="no_hp" />
                        @enderror
                    </div>
                    <div class="mt-4 flex items-end gap-3">
                        <template x-if="title == 'Edit Pelanggan'">
                            <x-button-green x-bind:disabled="loading">
                                <span class="mr-2" x-show="loading">
                                    <x-loading w="5" h="5" />
                                </span>
                                <span x-text="title"></span>
                            </x-button-green>
                        </template>
                        <template x-if="title == 'Tambah Pelanggan'">
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
</div>
