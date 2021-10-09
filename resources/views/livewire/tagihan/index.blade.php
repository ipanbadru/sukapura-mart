<div>
    <div class="bg-white oveflow-auto">
        <div class="mb-2">
            <x-input type="text" placeholder="Cari Tagihan...." wire:model="search"/>
            <x-button type="button" color="indigo">Cari</x-button>
        </div>
        <x-table>
            <x-slot name="th">
                <th class="py-3 px-4">No</th>
                <th class="py-3 px-4">Nik</th>
                <th class="py-3 px-4">Nama Pelanggan</th>
                <th class="py-3 px-4">No HP</th>
                <th class="py-3 px-4">Total Tagihan</th>
                <th class="py-3 px-4">Aksi</th>
            </x-slot>
            <?php $index = ($pelanggan->currentPage() - 1) * 10 + 1 ?>
            @if ($pelanggan->count() > 0)
            @foreach ($pelanggan as $item)
            <tr class="hover:bg-gray-50">
                <td class="border-t border-b py-3 px-4">{{ $index++; }}</td>
                <td class="border-t border-b py-3 px-4">{{ $item->nik }}</td>
                <td class="border-t border-b py-3 px-1">{{ $item->nama_pelanggan }}</td>
                <td class="border-t border-b py-3 px-1">{{ $item->no_hp }}</td>
                <td class="border-t border-b py-3 px-4">{{ $item->jumlah_tagihan }}</td>
                <td class="border-t border-b py-3 px-4 text-center">
                    <x-button type="button" wire:click="getPelanggan({{ $item->id }})">Bayar</x-button>
                </td>
            </tr>
            @endforeach
            @else
            <tr class="border-t border-b">
                <td class="text-gray-600 text-center py-4 text-lg" colspan="6">Tagihan Tidak tersedia</td>
            </tr>
            @endif
        </x-table>
        <div class="my-4">{{ $pelanggan->links() }}</div>
    </div>
    @livewire('tagihan.bayar')
</div>
