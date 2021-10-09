<div x-data="kasir()">
    <div class="pb-3 flex flex-col lg:flex-row justify-between gap-y-3 lg:items-center">
        <x-button type="button" color="blue"
            @click="openModal = true; errors = {}; resetInput(); title = 'Tambah Kasir'; action = '{{ route('register') }}'; method = 'POST'">
            Tambah Kasir</x-button>
        @include('kasir._modal-kasir')
        <div>
            <x-input type="text" name="" wire:model="search" placeholder="Cari Kasir....." />
            <x-button color="indigo">Cari</x-button>
        </div>
    </div>
    <div class="bg-white overflow-auto">
        <x-table>
            <x-slot name="th">
                <th class="py-3 px-4">No</th>
                <th class="py-3 px-4">Nama Kasir</th>
                <th class="py-3 px-4">Username</td>
                <th class="py-3 px-4">Email</td>
                <th class="py-3 px-4">Aksi</td>
            </x-slot>
            <?php $index = ($kasir->currentPage() - 1) * 10 + 1 ?>
            @if ($kasir->count() > 0)
            @foreach ($kasir as $item)
            <tr class="hover:bg-gray-50">
                <td class="border-t border-b py-3 px-4">{{ $index++; }}</td>
                <td class="border-t border-b py-3 px-4">{{ $item->nama }}</td>
                <td class="border-t border-b py-3 px-1">{{ $item->username }}</td>
                <td class="border-t border-b py-3 px-4">{{ $item->email }}</td>
                <td class="border-t border-b py-3 px-4 text-center">
                    <x-button type="button"
                        @click="openModal = true; title = 'Edit Kasir'; errors = {}; nama = '{{ $item->nama }}'; username = '{{ $item->username }}'; email = '{{ $item->email }}'; password = '', password_confirmation = '', action = '{{ route('kasir.update', $item->id) }}'; method = 'PUT'"
                        color="emerald">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </x-button>
                    <x-button type="button" x-on:click="hapusKasir('{{ route('kasir.destroy', $item->id) }}')"
                        class="text-right" color="red">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </x-button>
                </td>
            </tr>
            @endforeach
            @else
            <tr class="border-t border-b">
                <td class="text-gray-600 text-center py-4 text-lg" colspan="5">Kasir Tidak tersedia</td>
            </tr>
            @endif
        </x-table>
    </div>
    <div class="my-4">{{ $kasir->links() }}</div>
</div>
