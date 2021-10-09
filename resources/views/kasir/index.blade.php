<x-app-layout>
    @slot('title')
        Data Kasir
    @endslot
    <x-card>
        @slot('header')
        Data Kasir
        @endslot
        @livewire('kasir.index')
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