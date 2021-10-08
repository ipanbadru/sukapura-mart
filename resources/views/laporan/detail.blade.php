<x-app-layout>
    <x-slot name="title">Laporan Detail</x-slot>
    <main class="w-full flex-grow p-6">
            <x-card>
                @slot('header')
                    <span>Detail Laporan</span>
                    <x-anchor :href="route('laporan')" color="green"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                      </svg>Kembali</x-anchor>
                @endslot
                <div class="flex justify-center mt-3">
                        <div class="bg-white w-10/12 p-4 pb-0 rounded-md border-t shadow-lg relative">
                            <h2 class="text-gray-500 text-lg font-semibold flex flex-col lg:flex-row gap-y-3 justify-between">
                                <span>Kasir : {{ $transaksi->user->nama }}</span>
                                <span>Waktu Transaksi {{ date('d-m-Y H:i', strtotime($transaksi->created_at)) }}</span>
                            </h2>
                            <h2 class="text-gray-700 text-2xl pb-1 flex justify-between mt-3">
                                <span>Barang Terjual</span>
                                <span class="text-gray-900">Sub Total</span>
                            </h2>
                            <ul class="p-2">
                                @foreach ($transaksi->detail as $detail)
                                    <li class="flex flex-col lg:flex-row lg:items-center justify-between">
                                        <h1 class="text-xl text-gray-600 w-3/4 my-1">
                                            {{ $detail->barang->nama_barang }}
                                            <span class="block">x {{ $detail->total_barang }}</span>
                                        </h1>
                                        <h1 class="text-xl text-gray-800 w-1/4 text-right ml-auto">Rp. {{ number_format($detail->harga_barang * $detail->total_barang, 0, '.', '.') }}</h1>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="absolute right-0 left-0 h-0.5 bg-gray-100"></div>
                            <ul class="pt-4 border-l float-right w-3/5 px-2 pb-2">
                                <li class="flex flex-col lg:flex-row lg:items-center justify-between">
                                    <h1 class="text-xl text-gray-600 w-2/4">
                                        Total Harga
                                    </h1>
                                    <h1 class="text-xl text-gray-800 w-2/4 ml-auto text-right lg:m-0">{{ $transaksi->total_harga }}</h1>
                                </li>
                                <li class="flex flex-col lg:flex-row lg:items-center justify-between">
                                    <h1 class="text-xl text-gray-600 w-2/4 my-2">
                                        Jumlah Bayar
                                    </h1>
                                    <h1 class="text-xl text-gray-800 w-2/4 ml-auto text-right lg:m-0">{{ $transaksi->jumlah_bayar }}</h1>
                                </li>
                                <li class="flex flex-col lg:flex-row lg:items-center justify-between">
                                    <h1 class="text-xl text-gray-600 w-2/4 my-1">
                                        Kembalian
                                    </h1>
                                    <h1 class="text-xl text-gray-800 w-2/4 ml-auto text-right lg:m-0">{{ $transaksi->kembalian }}</h1>
                                </li>
                            </ul>
                        </div>

                </div>
            </x-card>
        <div class="w-full mt-2">
        </div>
    </main>
</x-app-layout>
