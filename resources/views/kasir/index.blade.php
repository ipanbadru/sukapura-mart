<x-app-layout>
    @slot('title')
        Data Kasir
    @endslot
    <x-card x-data="kasir({{ $kasir->toJson() }}, '{{ route('kasir.index') }}')">
        @slot('header')
        Data Kasir
        @endslot
        <div class="pb-3 flex flex-col lg:flex-row justify-between gap-y-3 lg:items-center">
            <x-button type="button" color="blue" 
            @click="openModal = true; errors = {}; resetInput(); title = 'Tambah Kasir'; action = '{{ route('register') }}'; method = 'POST'">Tambah Kasir</x-button>
            @include('kasir._modal-kasir')
            <form action="{{ route('kasir.index') }}">
                <x-input type="text" name="search" value="{{ request()->search }}"
                    placeholder="Cari Kasir....." />
                <x-button color="indigo">Cari</x-button>
            </form>
        </div>
        <div class="bg-white overflow-auto">
            <x-table>
                <x-slot name="th">
                    <th class="py-3 px-4 border">No</th>
                    <th class="py-3 px-4 border">Nama Kasir</th>
                    <th class="py-3 px-4 border">Username</td>
                    <th class="py-3 px-4 border">Email</td>
                    <th class="py-3 px-4 border">Aksi</td>
                </x-slot>
                <?php $index = ($kasir->currentPage() - 1) * 10 + 1 ?>
                <template x-if="dataKasir.length > 0">
                    <template x-for="data of dataKasir">
                        <tr class="hover:bg-gray-50">
                            <td class="border py-3 px-4">{{ $index; }}</td>
                            <?php $index = $index + 1; ?>
                            <td class="border py-3 px-4" x-text="data.nama"></td>
                            <td class="border py-3 px-1" x-text="data.username"></td>
                            <td class="border py-3 px-4" x-text="data.email"></td>
                            <td class="border py-3 px-4 text-center">
                                <x-button type="button" @click="openModal = true; title = 'Edit Kasir'; errors = {}; nama = data.nama; username = data.username; email = data.email; password = '', password_confirmation = '', action = url + '/' + data.id; method = 'PUT'" color="emerald">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </x-button>
                                <x-button type="button" @click="hapusKasir(data.id)" class="text-right" color="red">
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
                <template x-if="dataKasir.length <= 0">
                    <tr class="border">
                        <td class="text-gray-600 text-center py-4 text-lg" colspan="5">Kasir Tidak tersedia</td>
                    </tr>  
                </template>
            </x-table>
            <div class="my-4">{{ $kasir->links() }}</div>
        </div>
    </x-card>


    <x-slot name="script">
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
        <script src="{{ asset('js/kasir.js') }}"></script>
    </x-slot>
</x-app-layout>