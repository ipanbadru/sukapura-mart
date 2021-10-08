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
            {{-- Form Import Excel --}}
            <div x-show="title == 'Import pelanggan dari Excel'">
                <form action="{{ route('pelanggan.import') }}" method="post" enctype="multipart/form-data">
                    <span class="text-base font-semibold">Belum ada Template? <a href="{{ route('pelanggan.templatepelanggan') }}" class="text-blue-500 hover:text-blue-600">Download Template</a></span>
                    @csrf
                    <label for="file"
                        class="flex items-center my-5 border rounded-lg cursor-pointer w-full">
                        <div class="border-r flex items-center py-2 px-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            <span>Pilih File</span>
                        </div>
                        <span class="px-5 text-gray-700" id="file-label">Tidak ada file yang dipilih</span>
                    </label>
                    <input type="file" class="hidden" id="file" name="file" onchange="return changeLabel()">
                    <x-button color="green">Import Pelanggan</x-button>
                    <x-button type="button" color="blue-gray" @click="openModal = false">Batal</x-button>
                </form>
            </div>

            {{-- Form Tambah / Update Pelanggan --}}
            <div x-show="title == 'Tambah Pelanggan'">
                <form x-bind:action="action" @submit="submited" id="form" novalidate>
                    @csrf
                    <div>
                        <x-label for="nik" :value="__('Nik')" />
                        <x-input id="nik" class="block mt-1 w-full" x-bind:class="errors.nik ? 'border-red-500' : ''"
                            type="text" name="nik" :value="old('nik')" x-model="nik" required autofocus />
                        <span class="text-sm mt-1 text-red-600" x-text="errors.nik"></span>
                    </div>
                    <div class="mt-4">
                        <x-label for="nama_pelanggan" :value="__('Nama Pelanggan')" />
                        <x-input id="nama_pelanggan" class="block mt-1 w-full"
                            x-bind:class="errors.nama_pelanggan ? 'border-red-500' : ''" type="text" name="nama_pelanggan"
                            :value="old('nama_pelanggan')" x-model="nama_pelanggan" required autofocus />
                        <span class="text-sm mt-1 text-red-600" x-text="errors.nama_pelanggan"></span>
                    </div>
                    <div class="mt-4">
                        <x-label for="no_hp" :value="__('No Hp')" />
                        <x-input id="no_hp" class="block mt-1 w-full" x-bind:class="errors.no_hp ? 'border-red-500' : ''"
                            type="text" name="no_hp" x-model="no_hp" :value="old('no_hp')" required />
                        <span class="text-sm mt-1 text-red-600" x-text="errors.no_hp"></span>
                    </div>
                    <div class="mt-4 flex items-end gap-3">
                        <x-button x-bind:disabled="loading"
                            x-bind:class="title == 'Edit Pelanggan' ? 'bg-emerald-500 hover:bg-emerald-600' : ''">
                            <span class="mr-2" x-show="loading">
                                <x-loading w="5" h="5" />
                            </span>
                            <span x-text="title"></span>
                        </x-button>
                        <x-button type="button" color="blue-gray" @click="openModal = false">Batal</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
