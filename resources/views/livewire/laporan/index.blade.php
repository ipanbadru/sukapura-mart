<div>
    <x-card class="rounded-xl pt-2" 
    x-data="{data : '{{ request('dataLaporan') }}', tgl: '{{ request('tgl') }}', tgl_mulai: '{{ request('tgl_mulai') }}', tgl_akhir: '{{ request('tgl_akhir') }}', bulan: '{{ request('bulan') }}', tahun: '{{ request('tahun') }}'}">
        @slot('header')
        <h2 class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
        </svg>Filter Data</h2>
        <x-button type="button" @click="(() => $wire.resetData().then(() => {
            data = '';
            tgl = '';
            tgl_mulai = '';
            tgl_akhir = '';
            bulan = '';
            tahun = '';
            }))">Reset</x-button>
        @endslot
        <form action=""
        @submit="(e => {
            e.preventDefault();
            $wire.filterData(data, tgl, tgl_mulai, tgl_akhir, bulan, tahun);
        })">
            <div class="flex justify-between items-end"">
                <label for="data" class="text-lg w-1/3 mr-2">Data
                    <x-select name="data" id="data" x-model="data" 
                    @change="tgl = ''; tgl_mulai = ''; tgl_akhir = ''; bulan = ''; tahun = '';"
                    >
                        <option value="" disabled selected hidden>-- Filter Data --</option>
                        <option value="harian">Data Per Hari</option>
                        <option value="mingguan">Data Per Minggu</option>
                        <option value="bulanan">Data Per Bulan</option>
                    </x-select>
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
                <div class="flex">
                    <div>
                        <form action="{{ route('laporan.exportexcel') }}" method="post">
                            @csrf
                            <input type="hidden" name="data" wire:model="dataLaporan">
                            <input type="hidden" name="tgl" wire:model="tgl">
                            <input type="hidden" name="tgl_mulai" wire:model="tgl_akhir">
                            <input type="hidden" name="tgl_akhir" wire:model="tgl_akhir">
                            <input type="hidden" name="bulan" wire:model="bulan">
                            <input type="hidden" name="tahun" wire:model="tahun">
                            <x-button-green><svg
                                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                </svg>Export Excel</x-button-green>
                        </form>
                    </div>
                    <div class="ml-3">
                        <form action="{{ route('laporan.exportpdf') }}" method="post">
                            @csrf
                            <input type="hidden" name="data" wire:model="dataLaporan">
                            <input type="hidden" name="tgl" wire:model="tgl">
                            <input type="hidden" name="tgl_mulai" wire:model="tgl_akhir">
                            <input type="hidden" name="tgl_akhir" wire:model="tgl_akhir">
                            <input type="hidden" name="bulan" wire:model="bulan">
                            <input type="hidden" name="tahun" wire:model="tahun">
                            <x-button-red><svg
                                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>Export PDF</x-button-red>
                        </form>
                    </div>
                </div>
                @endif
            </div>
            <x-search placeholder="Cari Transaksi..."/>
        </div>
        <div class="bg-transparent overflow-auto">
            <x-table>
                <x-slot name="th">
                    <th class="py-3 px-4">No</th>
                    <th class="py-3 px-4">Tanggal</th>
                    <th class="py-3 px-4">Total Harga</th>
                    <th class="py-3 px-4">Jumlah Bayar</th>
                    <th class="py-3 px-4">Kembalian</th>
                    <th class="py-3 px-4">Id Transaksi</th>
                    <th class="py-3 px-4">Aksi</th>
                </x-slot>
                @if ($transaksi->count() === 0)
                <tr class="border">
                    <td colspan="7" class="text-center text-xl text-gray-600 py-3 md">Data Tidak ditemukan</td>
                </tr>
                @endif
                <?php $index = ($transaksi->currentPage() - 1) * 10 + 1 ?>
                @foreach ($transaksi as $item)
                <tr class="hover:bg-gray-100 {{ $index % 2 == 0 ? 'bg-gray-50' : '' }}">
                    <td class="border-t border-b py-3 px-4">{{ $index++ }}</td>
                    <td class="border-t border-b py-3 px-4">{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                    <td class="border-t border-b py-3 px-4">{{ $item->total_harga }}</td>
                    <td class="border-t border-b py-3 px-4">{{ $item->jumlah_bayar }}</td>
                    <td class="border-t border-b py-3 px-4">{{ $item->kembalian }}</td>
                    <td class="border-t border-b py-3 px-4 text-center">{{ $item->id }}</td>
                    <td class="border-t border-b py-3 px-4 text-center">
                        <x-button wire:loading.attr="disabled" color="blue-gray" wire:click="detailTransaksi({{ $item->id }})"><svg
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h7" />
                            </svg>Detail</x-button>
                    </td>
                </tr>
                @endforeach
            </x-table>
        </div>
        <div class="mt-3">{{ $transaksi->links() }}</div>
    </x-card>

    @include('laporan._modal-laporan-detail')
</div>
