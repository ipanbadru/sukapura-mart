<div class="p-4 border rounded-md shadow-md bg-blue-gray-50">
    <div class="grid grid-cols-10 gap-4 w-full">
        <div class="col-span-10 lg:col-span-7 xl:col-span-5">
            <x-label for="kode_barang" :value="__('Kode Barang')" />
            <div class="flex flex-col gap-y-3 sm:flex-row" x-data="{kodeBarang : '{{ request('kode_barang') ?? $barang->kode_barang }}', loading : false}">
                <div class="flex-1 relative">
                    <x-input id="kode_barang" class="block mt-1 w-full" type="text" name="kode_barang"
                     required autofocus x-model="kodeBarang" />
                     <div class="absolute top-3 right-3" x-show="loading">
                         <x-loading w="6" h="6"/>
                     </div>
                </div>
                <button 
                type="button"
                class="sm:ml-4 rounded-lg px-5 py-3 bg-cyan-500 text-white focus:outline-none focus:ring focus:ring-cyan-200 font-semibold text-sm tracking-wider"
                @click="loading = true;
                fetch('/barang/generate',{
                    headers : {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    }
                }
                ).then(response => response.json()).then(kode => {kodeBarang = kode; loading = false;})"
                >Generate Kode Barang</button>
            </div>
            @error('kode_barang')
            <span class="text-sm mt-1 text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-span-10 lg:col-span-3 xl:col-span-5">
            <x-label for="nama_barang" :value="__('Nama Barang')" />
            <x-input id="nama_barang" class="block mt-1 w-full" type="text" name="nama_barang" :value="old('nama_barang') ?? $barang->nama_barang"
                required autofocus />
            @error('nama_barang')
            <span class="text-sm mt-1 text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-span-5 sm:col-span-4">
            <x-label for="harga_beli" :value="__('Harga Beli')" />
            <x-input id="harga_beli" class="block mt-1 w-full text-right" type="text" name="harga_beli" :value="old('harga_beli') ?? ($barang->harga_beli !== 'Rp. 0' ?? '')"
                required autofocus />
            @error('harga_beli')
            <span class="text-sm mt-1 text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-span-5 sm:col-span-4">
            <x-label for="harga_jual" :value="__('Harga Jual')" />
            <x-input id="harga_jual" class="block mt-1 w-full text-right" type="text" name="harga_jual" :value="old('harga_jual') ?? ($barang->harga_jual !== 'Rp. 0' ?? '')"
                required autofocus />
            @error('harga_jual')
            <span class="text-sm mt-1 text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-span-10 sm:col-span-2">
            <x-label for="jumlah_barang" :value="__('Jumlah Barang')" />
            <x-input id="jumlah_barang" class="block mt-1 w-full" type="text" name="jumlah_barang"
                :value="old('jumlah_barang') ?? $barang->jumlah_barang" required autofocus />
            @error('jumlah_barang')
            <span class="text-sm mt-1 text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-span-10">
            <x-button color="blue">
                {{ $button }} Barang
            </x-button>
        </div>
    </div>
</div>
