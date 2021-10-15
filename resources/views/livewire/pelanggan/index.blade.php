<div x-data="pelanggan()">
    <div class="pb-3 flex flex-col lg:flex-row justify-between gap-y-3 lg:items-center">
        <div class="flex items-end gap-3">
            <x-button type="button"
                @click="openModal = true; resetInput(); title = 'Tambah Pelanggan'; $wire.resetValidate()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                </svg>
                <span>Tambah Pelanggan</span>
            </x-button>
            <x-button-green type="button" @click="openModalImport = true;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                </svg>
                <span>Import</span>
            </x-button-green>
        </div>
        <x-search placeholder="Cari Pelanggan..." />
    </div>
    <div class="bg-white overflow-auto">
        <x-table>
            @slot('th')
            <th class="py-3 px-4">No</th>
            <th class="py-3 px-4">Nik</th>
            <th class="py-3 px-4">Nama Pelanggan</th>
            <th class="py-3 px-4">No Hp</th>
            <th class="py-3 px-4">Aksi</th>
            @endslot
            <?php $index = ($pelanggan->currentPage() - 1) * 10 + 1 ?>
            @if ($pelanggan->count() > 0)
                @foreach ($pelanggan as $item)
                <tr class="hover:bg-gray-100 {{ $index % 2 == 0 ? 'bg-gray-50' : '' }}">
                    <td class="border-t border-b py-3 px-4">{{ $index++ }}</td>
                    <td class="border-t border-b py-3 px-4">{{ $item->nik }}</td>
                    <td class="border-t border-b py-3 px-4">{{ $item->nama_pelanggan }}</td>
                    <td class="border-t border-b py-3 px-4">{{ $item->no_hp }}</td>
                    <td class="border-t border-b py-3 px-4 text-center">
                        <x-button-green type="button"
                            @click="openModal = true; title = 'Edit Pelanggan'; id_pelanggan = {{ $item->id }}, nik = '{{ $item->nik }}'; nama_pelanggan = '{{ $item->nama_pelanggan }}'; no_hp = '{{ $item->no_hp }}'; $wire.resetValidate()"
                            >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </x-button-green>
                        <x-button-red type="button" @click="            
                        swal.fire({
                            title: 'Yakin?',
                            text: 'Apakah anda yakin akan menghapus Pelanggan?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#7367f0',
                            cancelButtonColor: '#ef4444',
                            confirmButtonText: 'Hapus',
                            cancelButtonText: 'Batal',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $wire.hapusPelanggan({{ $item->id }});
                            }
                        })" class="text-right" color="red">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </x-button-red>
                    </td>
                </tr>
                @endforeach
            @else
                <tr class="border-t border-b">
                    <td class="text-gray-600 text-center py-4 text-lg" colspan="5">Pelanggan Tidak tersedia</td>
                </tr>
            @endif
        </x-table>
        <div class="my-2 bg-transparent overflow-auto">{{ $pelanggan->links() }}</div>
    </div>
    @include('pelanggan._modal-pelanggan')
    @include('pelanggan._modal-pelanggan-import')
</div>
