<div class="fixed inset-0 z-10 bg-gray-300 bg-opacity-30 flex justify-center items-center"
    x-bind:class="openModal ? '' : 'hidden'">
    <div class="bg-white shadow-xl rounded-xl relative py-1 xl:w-1/3" x-show="openModal"
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
            <div x-show="title == 'Import barang dari Excel'">
                <form action="{{ route('importbarang') }}" method="post" enctype="multipart/form-data">
                    <span class="text-base font-semibold">Belum ada Template? <a href="{{ route('templatebarang') }}" class="text-blue-500 hover:text-blue-600">Download Template</a></span>
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
                    <x-button-green>Import Barang</x-button-green>
                    <x-button type="button" color="blue-gray" @click="openModal = false">Batal</x-button>
                </form>
            </div>
            <div x-show="title == 'Cetak Barcode'">
                <div class="flex justify-center">
                    <div class="py-3 px-6 inline-flex items-center flex-col shadow-md">
                        <div x-html="barcode"></div>
                        <span x-text="kodeBarang"></span>
                    </div>
                </div>
                <form action="{{ route('barang.cetak_barcode') }}" method="post" class="mt-5">
                    @csrf
                    <div class="grid grid-cols-4 mb-5 gap-3">
                        <div class="col-span-2">
                            <x-label for="jumlah" :value="__('Jumlah')"/>
                            <x-input type="text" id="jumlah" name="jumlah" required  class="ml-1 w-full"/>
                        </div>
                        <div class="col-span-2">
                            <x-label for="kode_barang" :value="__('Kode Barang')"/>
                            <x-input type="text" id="kode_barang" name="kode_barang" x-model="kodeBarang" readonly class="ml-1 bg-gray-300 w-full"/>
                        </div>
                    </div>
                    <x-button>Cetak Barcode</x-button>
                    <x-button type="button" color="blue-gray" @click="openModal = false">Batal</x-button>
                </form>
            </div>
        </div>
    </div>
</div>
