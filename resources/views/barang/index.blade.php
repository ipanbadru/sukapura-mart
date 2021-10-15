<x-app-layout>
    <x-slot name="title">Data Barang</x-slot>
        <div>
            <x-card>
                @slot('header')
                Data Barang
                @endslot
                @livewire('barang.index')
            </x-card>
        </div>
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
        @error('file')
        <script>
            swal.fire(
                'Gagal',
                'Ada kesalahan pada saat import data',
                'error'
            );
        </script>
        @enderror
        <script>
            const changeLabel = () => {
                var fileValue = document.querySelector('#file').value;
                var fileNameStart = fileValue.lastIndexOf('\\');
                fileValue = fileValue.substr(fileNameStart + 1);
                const label = document.querySelector("#file-label");
                if (fileValue !== '') {
                    if (fileValue.length >= 21) {
                        label.textContent = fileValue.substr(0, 20) + '...';
                    } else {
                        label.textContent = fileValue;
                    }
                }
            }
        </script>
    </x-slot>
</x-app-layout>
