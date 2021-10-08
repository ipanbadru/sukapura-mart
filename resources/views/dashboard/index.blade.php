<x-app-layout>
    <x-slot name="title">Data Barang</x-slot>
    <div class="grid grid-cols-4 gap-6">
        <div class="col-span-1 flex items-center bg-white rounded-md border py-3 px-5 shadow-md">
            <div class="mr-4 rounded-full p-3 bg-blue-100 bg-opacity-50 text-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm0 2h10v7h-2l-1 2H8l-1-2H5V5z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div>
                <h2 class="text-gray-600 font-semibold tracking-wider">Stok Barang</h2>
                <h2 class="font-bold text-lg tracking-wide">{{ $stok }}</h2>
            </div>
        </div>
        <div class="col-span-1 flex items-center bg-white rounded-md border py-3 px-5 shadow-md">
            <div class="mr-4 rounded-full p-3 bg-violet-100 bg-opacity-50 text-violet-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                </svg>
            </div>
            <div>
                <h2 class="text-gray-600 font-semibold tracking-wider">Total Transaksi</h2>
                <h2 class="font-bold text-lg tracking-wide">{{ $penjualan }}</h2>
            </div>
        </div>
        <div class="col-span-1 flex items-center bg-white rounded-md border py-3 px-5 shadow-md">
            <div class="mr-4 rounded-full p-3 bg-green-100 bg-opacity-50 text-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div>
                <h2 class="text-gray-600 font-semibold tracking-wider">Total Pendapatan</h2>
                <h2 class="font-bold text-lg tracking-wide">{{ $pendapatan }}</h2>
            </div>
        </div>
        <div class="col-span-1 flex items-center bg-white rounded-md border py-3 px-5 shadow-md">
            <div class="mr-4 rounded-full p-3 bg-purple-100 bg-opacity-50 text-purple-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div>
                <h2 class="text-gray-600 font-semibold tracking-wider">Barang Terjual</h2>
                <h2 class="font-bold text-lg tracking-wide">{{ $barang_terjual }}</h2>
            </div>
        </div>
    </div>
    <div class="bg-white w-full rounded-md shadow-xl p-4 mt-4">
        <canvas id="myChart" class="w-full" height="400"></canvas>
    </div>

    @slot('script')
    <script src="{{ asset('js/chart.js') }}"></script>
    <script>
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    </script>
    @endslot
</x-app-layout>
