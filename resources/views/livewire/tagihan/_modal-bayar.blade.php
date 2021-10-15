<div x-data="{openModal: @entangle('openModal'), total_bayar: '',}" class="fixed inset-0 z-10 bg-gray-300 bg-opacity-30 flex justify-center items-center"
    x-bind:class="openModal ? '' : 'hidden'">
    <div class="bg-white shadow-xl rounded-xl relative py-1 xl:w-4/12" x-show="openModal"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="transform translate-y-52 opacity-80"
        x-transition:enter-end="transform translate-y-0 opacity-100"
        x-transition:leave="transition ease-in duration-500"
        x-transition:leave-start="transform translate-y-0 opacity-100"
        x-transition:leave-end="opacity-0 transform translate-y-48" @click.away="openModal = false; total_bayar = ''">
        <div class="flex items-center justify-between border-b pt-1 pb-2 px-4">
            <h2 class="font-semibold text-gray-800 tracking-wide">Bayar Tagihan</h2>
            <button class="p-2 hover:bg-gray-100 text-gray-500 rounded-full transition-color duration-300"
                @click="openModal = false; total_bayar = ''"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="pb-3 w-full" x-init="$watch('openModal', (modal) => {
            total_bayar = ''
        })">
            <form action="" wire:submit.prevent="bayar">
                <input type="hidden" wire:model="id_tagihan">
                <div class="px-6 py-2 border-b bg-gray-50">
                    <span class="block text-gray-600 text-xl">Total Tagihan</span>
                    <span class="text-red-500 text-5xl text-right block">{{ $total_tagihan }}</span>
                </div>
                <div class="px-6 py-2 border-b bg-gray-50 relative">
                    <div class="absolute inset-0 bg-white bg-opacity-50" wire:loading wire:target="setSisaTagihan"></div>
                    <span class="block text-gray-600 text-xl">{{ $kembalian ? 'Kembalian' : 'Sisa Tagihan' }}</span>
                    <span class="{{ $kembalian ? 'text-green-500' : 'text-blue-500' }} text-5xl text-right block">{{ $kembalian ?? $sisa_tagihan }}</span>
                </div>
                <div class="px-6 pt-2">
                    <x-label id="nama_pelanggan">Nama Pelanggan</x-label>
                    <x-input type="text" id="nama_pelanggan" disabled wire:model="nama_pelanggan" class="block w-full bg-gray-100 my-2" />
                    
                    <x-label id="total_bayar" class="my-2">Total Bayar</x-label>
                    @error('total_bayar')
                        <x-input type="text" id="total_bayar" x-model="total_bayar" autocomplete="off" @keyup="total_bayar = formatRupiah(total_bayar, 'Rp. '); $wire.setSisaTagihan(total_bayar)" class="block w-full border-red-500" />
                        <span class="text-sm mt-1 text-red-600">{{ $message }}</span>
                    @else
                        <x-input type="text" id="total_bayar" x-model="total_bayar" autocomplete="off" @keyup="total_bayar = formatRupiah(total_bayar, 'Rp. '); $wire.setSisaTagihan(total_bayar)" class="block w-full" />
                    @enderror
                </div>
                <div class="mt-4 px-6 flex items-end gap-2">
                    <x-button wire:loading.attr="disabled">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                          </svg>
                        <span>Bayar</span>
                    </x-button>
                    <x-button type="button" color="gray" @click="openModal = false; total_bayar = ''">Batal</x-button>
                </div>
            </form>
        </div>
    </div>
</div>

