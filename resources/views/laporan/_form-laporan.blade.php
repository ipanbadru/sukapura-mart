<template  x-if="data === 'harian'">
    <div class="w-1/2">
        <div class="w-full flex justify-end items-end">
            <div class="w-2/5 mr-2">
                <label for="tgl" class="text-lg block">Tanggal</label>
                <input type="date" name="" id="tgl" x-model="tgl"
                    class="shadow rounded-md border-gray-300 w-full focus:outline-none focus:border-blue-600 focus:ring focus:ring-blue-300" required>
            </div>
            <div class="mb-0.5">
                <x-button><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                  </svg>Filter</x-button>
            </div>
        </div>
    </div>
</template>
<template x-if="data === 'mingguan'">
    <div class="w-1/2">
        <div class="flex justify-end w-full items-end">
            <div class="w-2/5">
                <label for="tgl_mulai" class="text-lg block">Mulai Tanggal</label>
                <input type="date" name="" id="tgl_mulai" 
                    x-model="tgl_mulai"
                    class="shadow w-full rounded-md border-gray-300 focus:outline-none focus:border-blue-600 focus:ring focus:ring-blue-300" required>
            </div>
            <div class="w-2/5 mr-2 ml-6">
                <label for="tgl_akhir" class="text-lg block">Sampai Tanggal</label>
                <input type="date" name="" id="tgl_akhir"
                    x-init="$watch('tgl_mulai', (date) => {
                        if(date != ''){
                            tgl_akhir = formatDate(new Date(date).addDays(7));
                        } else {
                            tgl_akhir = '';
                        }
                    })"
                    x-model="tgl_akhir"
                    readonly
                    class="shadow w-full rounded-md border-gray-300 focus:outline-none focus:border-gray-300 bg-gray-200" required>
            </div>
            <div class="mb-0.5">
                <x-button wire:target="filterData"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                  </svg>Filter</x-button>
            </div>
        </div>
    </div>
</template>
<template x-if="data === 'bulanan'">
    <div class="w-1/2">
        <div class="flex justify-end w-full items-end">
            <div class="w-2/5">
                <label for="bulan" class="text-lg block">Bulan</label>
                <x-select name="bulan" id="bulan" x-model="bulan" required>
                    <option value=""></option>
                    @foreach ($bulans as $index => $bulan)
                        <option value="{{ $index }}"{{ request('bulan') == $index ? 'selected' : '' }}>{{ $bulan }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="w-2/5 mr-2 ml-6">
                <label for="tahun" class="text-lg block">Tahun</label>
                <x-select name="tahun" id="tahun" x-model="tahun" required>
                    <option value=""></option>
                    @for ($i = 2021; $i <= $lastYear; $i++)
                        <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </x-select>
            </div>
            <div class="mb-0.5">
                <x-button wire:target="filterData"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                  </svg>Filter</x-button>
            </div>
        </div>
    </div>
</template>
