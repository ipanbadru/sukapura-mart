<div class="fixed inset-0 z-10 bg-gray-300 bg-opacity-30 flex justify-center items-center"
    x-bind:class="openModalImport ? '' : 'hidden'">
    <div class="bg-white shadow-xl rounded-xl relative py-1 w-10/12 md:w-7/12 lg:w-5/12 xl:w-4/12" x-show="openModalImport"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="transform translate-y-52 opacity-80"
        x-transition:enter-end="transform translate-y-0 opacity-100"
        x-transition:leave="transition ease-in duration-500"
        x-transition:leave-start="transform translate-y-0 opacity-100"
        x-transition:leave-end="opacity-0 transform translate-y-48" @click.away="openModalImport=false">
        <div class="flex items-center justify-between border-b pt-1 pb-2 px-4 mb-4">
            <h2 class="font-semibold text-gray-800 tracking-wide">Import Pelanggan Dari Excel</h2>
            <button class="p-2 hover:bg-gray-100 text-gray-500 rounded-full transition-color duration-300"
                @click="openModalImport = false"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="px-6 pb-3 w-full">
            <div>
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
                    <x-button-green>Import Pelanggan</x-button-green>
                    <x-button type="button" color="blue-gray" @click="openModalImport = false">Batal</x-button>
                </form>
            </div>
        </div>
    </div>
</div>
