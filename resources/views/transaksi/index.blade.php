<x-app-layout>
    <x-slot name="title">Transaksi</x-slot>
    <div x-data="transaksi({{ $barang->toJson() }})">
        <div class="grid grid-cols-3 mb-7 gap-3">
            <div class="col-span-1 bg-white shadow px-4 pt-2 pb-4 rounded-md">
                <x-label id="metode_pembayaran" class="text-lg text-gray-600 mb-2" value="Metode Pembayaran" />
                <select name="metode_pembayaran" id="metode_pembayaran" x-model="metode_pembayaran"
                    @change="cekMetodePembayaran">
                    <option value="cash">Cash</option>
                    <option value="credit">Credit</option>
                </select>
            </div>
            <div class="col-span-1 bg-white shadow px-4 pt-2 pb-4 rounded-md">
                <x-label id="pelanggan" class="text-lg text-gray-600 mb-2" value="Nama Pelanggan" />
                <select name="pelanggan" id="pelanggan" x-model="pelanggan">
                    <option value=""></option>
                    @foreach ($pelanggan as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_pelanggan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-1 bg-white shadow px-4 py-2 rounded-md">
                <span class="block text-gray-600 text-right text-lg">Total Harga</span>
                <span class="text-red-400 text-5xl text-right block" x-text="totalHarga"></span>
            </div>
            {{-- <div class="col-span-1 bg-white shadow px-4 py-2 rounded-md">
                <span class="block text-gray-600 text-right text-lg">Total Kembalian</span>
                <span class="text-green-400 text-5xl text-right block" x-text="kembalian"></span>
            </div> --}}
        </div>
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-6 lg:col-span-4">
                <x-card class="min-h-full">
                    @slot('header')
                    Daftar Barang
                    @endslot
                    <form action="{{ route('transaksi.index') }}" @submit="submitedSearch" id="form-search-barang">
                        <div class="mb-10 relative h-11">
                            <x-input type="text" id="input-barang" class="block w-full" placeholder="Scan Barang....."
                                x-model="search" autofocus autocomplete="off" @click.away="open=false" @keyup="searchBarangs"/>
                            <div class="absolute right-1 top-2" x-show="loadingAddBarangBelanja">
                                <x-loading w="6" h="6" />
                            </div>
                            <span class="pt-2" x-show="loadingSearch">Loading.....</span>
                            <template x-if="resultSearchBarang.length > 0">
                                <ul class="w-full bg-white mt-3 border-l border-b border-r"
                                    x-show="open && search != ''">
                                    <template x-for="barang of resultSearchBarang">
                                        <li class="px-3 py-1 font-semibold cursor-pointer hover:bg-gray-100 border-b flex justify-between items-center"
                                            @click="setSearch(barang.nama_barang)">
                                            <div>
                                                <span class="block text-gray-700" x-text="barang.nama_barang"></span>
                                                <span class="block text-xs text-gray-500"
                                                    x-text="barang.harga_jual"></span>
                                            </div>
                                            <span class="text-gray-600" x-text="`Stok ${barang.jumlah_barang}`"></span>
                                        </li>
                                    </template>
                                </ul>
                            </template>
                        </div>
                    </form>
                    <x-table>
                        <x-slot name="th">
                            <th class="py-3 px-4 border">No</th>
                            <th class="py-3 px-4 border w-2/5">Nama Barang</td>
                            <th class="py-3 px-4 border w-1/5">Jumlah</td>
                            <th class="py-3 px-4 border">Harga</td>
                            <th class="py-3 px-4 border">Aksi</td>
                        </x-slot>
                        <template x-for="(barang, index) of barangBelanja">
                            <tr class="hover:bg-gray-100">
                                <td class="border py-3 px-4" x-text="index + 1"></td>
                                <td class="border py-3 px-4" x-text="barang.nama_barang"></td>
                                <td class="border py-3 px-4 w-1/5">
                                    <div class="grid grid-cols-4">
                                        <button @click="decrement(index)"
                                            class="col-span-1 bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full rounded-l cursor-pointer outline-none">
                                            <span class="m-auto text-2xl font-thin">−</span>
                                        </button>
                                        <input @keyup="resetHarga(index)" type="number" id="input-jumlah"
                                            class="col-span-2 outline-none focus:outline-none focus:border-transparent border-0 text-center bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700 "
                                            name="custom-input-number" x-model="barangBelanja[index].jumlah" />
                                        <button @click="increment(index)"
                                            class="col-span-1 bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full rounded-r cursor-pointer outline-none">
                                            <span class="m-auto text-2xl font-thin">+</span>
                                        </button>
                                    </div>
                                </td>
                                <td class="border py-3 px-4" x-text="barang.harga"></td>
                                <td class="border py-3 px-4">
                                    <button id="hapus-barang" @click="hapusBarangBelanja(index)"
                                        class="p-2 text-sm rounded-md bg-red-500 hover:bg-red-600 text-white focus:outline-none focus:ring focus:ring-red-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </x-table>
                </x-card>
            </div>
            <div class="col-span-6 lg:col-span-2">
                <x-card>
                    @slot('header')
                    Pembayaran
                    @endslot
                    <form x-bind:action="metode_pembayaran == 'cash' ? '{{ route('transaksi.cash') }}' : '{{ route('transaksi.credit') }}'" 
                    @submit="submitedBayar" id="form-bayar" autocomplete="off">
                        <h1 class=" mr-1 text-gray-700 font-bold tracking-wider text-lg">Kasir</h1>
                        <x-input id="total-harga" class="block my-2 w-full bg-gray-100" type="text"
                            value="{{ Auth::user()->nama }}" :disabled="true" />
                        <h1 class="text-right mr-1  text-gray-700 font-bold tracking-wider text-lg">Total Bayar</h1>
                        <x-input id="total-bayar" class="block my-2 w-full text-right none" type="text"
                            x-model="totalBayar" @keyup="total = totalBayar" />
                        <div x-show="metode_pembayaran == 'cash'">
                            <h1 class="text-right mr-1 text-gray-700 font-bold tracking-wider text-lg">Kembalian</h1>
                            <x-input id="total-kembali" class="block my-2 w-full text-right bg-gray-100" type="text"
                                x-model="kembalian" :disabled="true" />
                        </div>
                        <div x-show="metode_pembayaran == 'credit'">
                            <h1 class="text-right mr-1 text-gray-700 font-bold tracking-wider text-lg">Sisa Tagihan</h1>
                            <x-input id="total-kembali" class="block my-2 w-full text-right bg-gray-100" type="text"
                                x-model="sisaTagihan" :disabled="true" />
                        </div>
                        <x-button class="w-full block justify-center mt-4"
                            x-bind:disabled="loadingTransaksi ? true : (disabledSubmit ? true : false)">
                            <div class="mr-2" x-show="loadingTransaksi">
                                <x-loading w="5" h="5" />
                            </div>
                            <span x-text="metode_pembayaran == 'cash' ? 'Bayar' : 'Credit'"></span>
                        </x-button>
                    </form>
                </x-card>
            </div>
        </div>
    </div>

    @slot('style')
    <link rel="stylesheet" href="/css/slim-select.css">
    @endslot
    <x-slot name="script">
        <script src="/js/slim-select.js"></script>
        <script src="/js/transaksi.js"></script>
        @if (session()->has('success'))
        <div class="message hidden">{{ session()->get('success') }}</div>
        <script>
            // Sweet Alert
            const message = document.querySelector('.message').innerHTML;
            swal.fire(
                'Berhasil',
                message,
                'success'
            );

        </script>
        @endif
    </x-slot>
</x-app-layout>
