<x-app-layout>
    <x-slot name="title">Edit Barang</x-slot>
    <x-card>
        @slot('header')
        <span>Edit Barang</span>
        <x-anchor :href="route('barang.index')" color="green"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>Kembali</x-anchor>
        @endslot
        <form action="{{ route('barang.update', $barang->id) }}" method="post" class="mt-4">
            @csrf
            @method('PUT')
            @include('barang._form')
        </form>
    </x-card>
    <x-slot name="script">
        <script>
            const hargaBeli = document.querySelector('#harga_beli');
            hargaBeli.addEventListener('keyup', function () {
                hargaBeli.value = formatRupiah(this.value, 'Rp. ');
            });
            const hargaJual = document.querySelector('#harga_jual');
            hargaJual.addEventListener('keyup', function () {
                hargaJual.value = formatRupiah(this.value, 'Rp. ');
            });

        </script>
    </x-slot>
</x-app-layout>
