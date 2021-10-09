<x-app-layout>
    @slot('title')
    Data Tagihan
    @endslot

    <x-card>
        @slot('header')
        Data Tagihan
        @endslot
        <livewire:tagihan.index />
    </x-card>
</x-app-layout>
