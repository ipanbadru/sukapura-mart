<div>
    <div class="pb-3 flex flex-col lg:flex-row justify-between gap-y-3 lg:items-center">
        <div class="flex flex-col sm:flex-row sm:items-center gap-y-3">
            @if ($tagihan->count() > 0)
            <div class="flex">
                <div>
                    <x-anchor color="green" :href="route('tagihan.export')"><svg
                            xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>Export Excel</x-anchor>
                </div>
            </div>
            @endif
        </div>
        <x-search placeholder="Cari Tagihann..."/>
    </div>
    <div class="bg-white oveflow-auto">
        <x-table>
            <x-slot name="th">
                <th class="py-3 px-4">No</th>
                <th class="py-3 px-4">Id Tagihan</th>
                <th class="py-3 px-4">Nik</th>
                <th class="py-3 px-4">Nama Pelanggan</th>
                <th class="py-3 px-4">No HP</th>
                <th class="py-3 px-4">Total Tagihan</th>
                <th class="py-3 px-4">Aksi</th>
            </x-slot>
            <?php $index = ($tagihan->currentPage() - 1) * 10 + 1 ?>
            @if ($tagihan->count() > 0)
            @foreach ($tagihan as $item)
            <tr class="hover:bg-gray-50">
                <td class="border-t border-b py-3 px-4">{{ $index++; }}</td>
                <td class="border-t border-b py-3 px-4 text-center">{{ $item->id }}</td>
                <td class="border-t border-b py-3 px-4">{{ $item->pelanggan->nik }}</td>
                <td class="border-t border-b py-3 px-1">{{ $item->pelanggan->nama_pelanggan }}</td>
                <td class="border-t border-b py-3 px-1">{{ $item->pelanggan->no_hp }}</td>
                <td class="border-t border-b py-3 px-4">{{ $item->total_tagihan }}</td>
                <td class="border-t border-b py-3 px-4 text-center">
                    <x-button type="button" wire:click="bayarTagihan({{ $item->id }})" wire:loading.attr="disabled">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                          </svg>
                        <span>Bayar</span>
                    </x-button>
                    <x-button type="button" color="blue-gray" wire:click="detailTagihan({{ $item->id }})" wire:loading.attr="disabled"  wire:target="bayarTagihan" wire:target="detailTagihan">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                        <span>Detail</span>
                    </x-button>
                </td>
            </tr>
            @endforeach
            @else
            <tr class="border-t border-b">
                <td class="text-gray-600 text-center py-4 text-lg" colspan="6">Tagihan Tidak tersedia</td>
            </tr>
            @endif
        </x-table>
        <div class="my-4 bg-transparent overflow-auto">{{ $tagihan->links() }}</div>
    </div>

    @include('livewire.tagihan._modal-bayar')

    @include('livewire.tagihan._modal-detail')
</div>
