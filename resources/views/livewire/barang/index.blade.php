<div x-data="{openModal : false, title : '', kodeBarang : '', barcode : ''}">
    <div class="pb-3 flex flex-col lg:flex-row justify-between gap-y-3 lg:items-center">
        <div class="flex flex-col sm:flex-row sm:items-center gap-y-3">
            <div>
                <x-anchor :href="route('barang.create')" color="violet" class="bg-violet-700 hover:bg-violet-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                  </svg><span>Tambah Barang</span></x-anchor>
            </div>
            <div class="flex sm:ml-3">
                <div>
                    <x-anchor :href="route('exportbarang')" color="green"><svg
                            xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg><span class="ml-1">Export</span></x-anchor>
                </div>
                <div class="ml-3">
                    <button type="button" @click="openModal = true; title = 'Import barang dari Excel'"
                        class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold tracking-wider text-sm text-white hover:bg-green-700 active:bg-green-800 focus:outline-none focus:ring ring-green-300 transition ease-in-out duration-150"><svg
                            xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg><span class="ml-1">Import</span></button>
                </div>
            </div>
        </div>
        <x-search placeholder="Cari Barang..." />
    </div>
    <div class="bg-white overflow-auto">
        <x-table>
            <x-slot name="th">
                <th class="py-3 px-4 w-2/6">Nama Barang</th>
                <th class="py-3 px-4">Barcode</th>
                <th class="py-3 px-4">Harga Beli</td>
                <th class="py-3 px-4">Harga Jual</td>
                <th class="py-3 px-4">Stok</td>
                <th class="py-3 px-4 w-1/6">Aksi</td>
            </x-slot>
            @if ($barang->count(1))
            @foreach ($barang as $index => $item)
            <tr class="hover:bg-gray-100 {{ $index % 2 == 1 ? 'bg-gray-50' : '' }}">
                <td class="border-t border-b py-3 px-4">{{ $item->nama_barang }}</td>
                <td class="border-t border-b py-3 px-1 group relative">
                    <div class="flex items-center flex-col text-center">
                        {!! $item->barcode !!}
                        {{ $item->kode_barang }}
                    </div>
                    <button type="button" 
                        @click="openModal = true; title = 'Cetak Barcode'; barcode = '{{ $item->barcode }}'; kodeBarang = '{{ $item->kode_barang }}'"
                        class="absolute opacity-0 group-hover:opacity-100 top-7 -right-16 py-2 px-4 shadow-lg rounded-xl rounded-tl-none bg-white hover:bg-blue-gray-100 transition-all duration-200"
                        target="_blank">Cetak Barcode</button>
                </td>
                <td class="border-t border-b py-3 px-4">{{ $item->harga_beli }}</td>
                <td class="border-t border-b py-3 px-4">{{ $item->harga_jual }}</td>
                <td class="border-t border-b py-3 px-4">{{ $item->jumlah_barang }}</td>
                <td class="border-t border-b py-3 px-4 text-center">
                    <x-anchor :href="route('barang.edit', $item->id)" color="green">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </x-anchor>
                    <x-button-red @click="            
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
                            $wire.hapusBarang({{ $item->id }});
                        }
                    })"
                    >
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
                <td class="text-gray-600 text-center py-4 text-lg" colspan="6">Barang Tidak tersedia</td>
            </tr>
            @endif
        </x-table>
        <div class="my-4 bg-transparent overflow-auto">{{ $barang->links() }}</div>
    </div>
    
    {{-- Modal --}}
    @include('barang._modal-barang')
</div>
