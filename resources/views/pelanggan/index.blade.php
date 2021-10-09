<x-app-layout>
    @slot('title')
    Data Pelanggan
    @endslot
    <x-card x-data="pelanggan({{ $pelanggan->toJson() }}, '{{ route('pelanggan.index') }}')">
        @slot('header')
        Data Pelanggan
        @endslot
        <div class="pb-3 flex flex-col lg:flex-row justify-between gap-y-3 lg:items-center">
            <div class="flex items-end gap-3">
                <x-button type="button" color="blue"
                    @click="openModal = true; errors = {}; resetInput(); title = 'Tambah Pelanggan'; action = '{{ route('pelanggan.store') }}'; method = 'POST'">
                    Tambah Pelanggan
                </x-button>
                <x-button type="button" color="green" @click="openModal = true; title = 'Import pelanggan dari Excel'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    <span>Import</span>
                </x-button>
            </div>
            <form action="{{ route('pelanggan.index') }}">
                <x-input type="text" name="search" value="{{ request()->search }}" placeholder="Cari Pelanggan....." />
                <x-button color="indigo">Cari</x-button>
            </form>
        </div>
        <div class="bg-white oveflow-auto">
            <x-table>
                @slot('th')
                <th class="py-3 px-4">No</th>
                <th class="py-3 px-4">Nik</th>
                <th class="py-3 px-4">Nama Pelanggan</th>
                <th class="py-3 px-4">No Hp</th>
                <th class="py-3 px-4">Aksi</th>
                @endslot
                <?php $index = ($pelanggan->currentPage() - 1) * 10 + 1 ?>
                <template x-if="dataPelanggan.length > 0">
                    <template x-for="(data, index) of dataPelanggan">
                        <tr class="hover:bg-gray-50">
                            <td class="border-t border-b py-3 px-4">{{ $index++ }}</td>
                            <td class="border-t border-b py-3 px-4" x-text="data.nik"></td>
                            <td class="border-t border-b py-3 px-4" x-text="data.nama_pelanggan"></td>
                            <td class="border-t border-b py-3 px-4" x-text="data.no_hp"></td>
                            <td class="border-t border-b py-3 px-4 text-center">
                                <x-button type="button"
                                    @click="openModal = true; title = 'Edit Pelanggan'; errors = {}; nik = data.nik; nama_pelanggan = data.nama_pelanggan; no_hp = data.no_hp; action = url + '/' + data.id; method = 'PUT'"
                                    color="emerald">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </x-button>
                                <x-button type="button" @click="hapusPelanggan(data.id)" class="text-right" color="red">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </x-button>
                            </td>
                        </tr>
                    </template>
                </template>
                <template x-if="dataPelanggan.length <= 0">
                    <tr class="border-t border-b">
                        <td class="text-gray-600 text-center py-4 text-lg" colspan="5">Pelanggan Tidak tersedia</td>
                    </tr>
                </template>
            </x-table>
        </div>
        @include('pelanggan._modal-pelanggan')
    </x-card>


    @slot('script')
    @if (session()->has('success'))
    <div class="message hidden">{{ session()->get('success') }}</div>
    <script>
        const message = document.querySelector('.message').innerHTML;
        swal.fire(
            'Berhasil',
            message,
            'success'
        );
    </script>
    @endif
    @error('file')
    <script>
        swal.fire(
            'Gagal',
            'Ada kesalahan pada saat import data',
            'error'
        );
    </script>
    @enderror
    <script src="{{ asset('js/pelanggan.js') }}"></script>
    @endslot
</x-app-layout>
