<div x-data="{openModal: @entangle('detail_modal')}" class="fixed inset-0 z-10 bg-gray-300 bg-opacity-30 flex justify-center items-center"
    x-bind:class="openModal ? '' : 'hidden'">
    <div class="bg-white shadow-xl rounded-xl relative py-1 xl:w-3/12 overflow-auto" x-show="openModal"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="transform translate-y-52 opacity-80"
        x-transition:enter-end="transform translate-y-0 opacity-100"
        x-transition:leave="transition ease-in duration-500"
        x-transition:leave-start="transform translate-y-0 opacity-100"
        x-transition:leave-end="opacity-0 transform translate-y-48" @click.away="openModal = false" style="max-height: 80vh">
        <div class="flex items-center justify-between border-b pt-1 pb-2 px-4">
            <h2 class="font-semibold text-gray-800 tracking-wide">Detail Tagihan</h2>
            <button class="p-2 hover:bg-gray-100 text-gray-500 rounded-full transition-color duration-300"
                @click="openModal = false"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="pb-3 w-full space-y-1">
            @if ($data_tagihan_detail)     
            <div class="px-6 text-gray-600 font-semibold border-b">
                <div class="flex items-center justify-between">
                    <span>Kasir</span>
                    <span>{{ $data_tagihan_detail->kasir->nama }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span>Pelanggan</span>
                    <span>{{ $data_tagihan_detail->pelanggan->nama_pelanggan }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span>Waktu Credit</span>
                    <span>{{ $data_tagihan_detail->created_at->diffForHumans() }}</span>
                </div>
            </div>
            <div class="px-6 py-2 text-gray-700 space-y-2 border-b">
                @foreach ($data_tagihan_detail->detail as $detail)
                    <div class="flex flex-col">
                        <span class="font-semibold">{{ $detail->barang->nama_barang }}</span>
                        <div class="flex items-center justify-between">
                            <span>x {{ $detail->total_barang }}</span>
                            <span>{{ $detail->harga_barang }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="px-6 py-2 text-gray-700 flex flex-col items-end space-y-1">
                <div class="w-2/3 flex justify-between">
                    <span>Total Harga</span> 
                    <span class="font-semibold">{{ $data_tagihan_detail->total_harga }}</span>
                </div>
                <div class="w-2/3 flex justify-between">
                    <span>Terbayar</span> 
                    <span class="font-semibold">{{ $data_tagihan_detail->terbayar }}</span>
                </div>
                <div class="w-2/3 flex justify-between">
                    <span>sisa Tagihan</span> 
                    <span class="font-semibold">{{ $data_tagihan_detail->total_tagihan }}</span>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

