<x-app-layout>
    @slot('title')
    Data Pelanggan
    @endslot
    <x-card>
        @slot('header')
        Data Pelanggan
        @endslot
        @livewire('pelanggan.index')
    </x-card>


    @slot('script')
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
