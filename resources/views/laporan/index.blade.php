<x-app-layout>
    <x-slot name="title">Laporan Transaksi</x-slot>
    <x-card class="rounded-xl pt-2">
        @slot('header')
        <h2 class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
        </svg>Filter Data</h2>
        <x-anchor :href="route('laporan')" color="violet">Reset</x-anchor>
        @endslot
        <form action="/laporan" x-data="dataLaporan('{{ request('data') }}')">
            <div class="flex justify-between items-end">
                <label for="data" class="text-lg w-1/3 mr-2">Data
                    <select name="data" id="data" x-model="data">
                        <option data-placeholder="true"></option>
                        <option value="harian">Data Per Hari</option>
                        <option value="mingguan">Data Per Minggu</option>
                        <option value="bulanan">Data Per Bulan</option>
                    </select>
                </label>
                @include('laporan._form-laporan')
            </div>
        </form>
    </x-card>
    <x-card class="pt-2 mt-8">
        @slot('header')
        <h2>
            {{ $title }}
        </h2>
        @endslot
        <div class="pb-3 flex flex-col lg:flex-row justify-between gap-y-3 lg:items-center">
            <div class="flex flex-col sm:flex-row sm:items-center gap-y-3">
                @if ($transaksi->count() > 0)
                <div class="flex sm:ml-3">
                    <div>
                        <x-anchor :href="route('laporan.exportexcel', request()->all())" color="green"><svg
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            </svg>Export Excel</x-anchor>
                    </div>
                    <div class="ml-3">
                        <x-anchor :href="route('laporan.exportpdf', request()->all())" color="red"><svg
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>Export PDF</x-anchor>
                    </div>
                </div>
                @endif
            </div>
            <form action="{{ route('laporan') }}">
                @foreach (request()->all() as $key => $value)
                @if ($key !== 'search')
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endif
                @endforeach
                <x-input type="text" name="search" value="{{ request()->search }}" placeholder="Cari Data....." />
                <x-button color="indigo">Cari</x-button>
            </form>
        </div>
        <x-table>
            <x-slot name="th">
                <th class="py-3 px-4 border">No</th>
                <th class="py-3 px-4 border">Id Transaksi</th>
                <th class="py-3 px-4 border">Total Harga</th>
                <th class="py-3 px-4 border">Jumlah Bayar</th>
                <th class="py-3 px-4 border">Kembalian</th>
                <th class="py-3 px-4 border">Tanggal</th>
                <th class="py-3 px-4 border">Aksi</th>
            </x-slot>
            @if ($transaksi->count() === 0)
            <tr class="border">
                <td colspan="7" class="text-center text-xl text-gray-600 py-3 md">Data Tidak ditemukan</td>
            </tr>
            @endif
            <?php $index = ($transaksi->currentPage() - 1) * 10 + 1 ?>
            @foreach ($transaksi as $item)
            <tr class="hover:bg-gray-50">
                <td class="border py-3 px-4">{{ $index++ }}</td>
                <td class="border py-3 px-4 text-center">{{ $item->id }}</td>
                <td class="border py-3 px-4">{{ $item->total_harga }}</td>
                <td class="border py-3 px-4">{{ $item->jumlah_bayar }}</td>
                <td class="border py-3 px-4">{{ $item->kembalian }}</td>
                <td class="border py-3 px-4">{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                <td class="border py-3 px-4 text-center">
                    <x-anchor :href="route('laporan.detail', $item->id)" color="blue"><svg
                            xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h7" />
                        </svg>Detail</x-anchor>
                </td>
            </tr>
            @endforeach
        </x-table>
        <div class="mt-3">{{ $transaksi->links() }}</div>
    </x-card>

    @slot('style')
        <link rel="stylesheet" href="{{ asset('css/slim-select.css') }}">
    @endslot
    @slot('script')
        <script src="{{ asset('js/slim-select.js') }}"></script>
        <script>
            const selectFilteringData = new SlimSelect({
                select: document.querySelector('select#data'),
                showSearch: false,
                placeholder: 'Filter Data',
            });

            const dataLaporan = (data) => {
                selectFilteringData.set(data);
                return {
                    data,
                }
            };
        </script>
    @endslot
</x-app-layout>
