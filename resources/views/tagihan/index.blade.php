<x-app-layout>
    @slot('title')
    Data Tagihan
    @endslot

    <x-card>
        @slot('header')
        Data Tagihan
        @endslot
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
        </x-table>
    </x-card>
</x-app-layout>
