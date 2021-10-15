<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | {{ $title }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        ::-webkit-scrollbar{
            width: 13px;
        }
        ::-webkit-scrollbar-track{
            background: #c4b5fd;
            box-shadow: 0 0 5px gray;
        }
        ::-webkit-scrollbar-thumb{
            background-image: linear-gradient(to bottom, #a78bfa, #7c3aed);
            border-radius: 6px;
            opacity: 1;
            transition: .5s
        }
        ::-webkit-scrollbar-thumb:hover{
            opacity: 1;
        }
    </style>

    @isset($style)
        {{ $style }}
    @endisset

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    @livewireStyles
</head>

<body class="bg-blue-gray-50 flex">

    @include('layouts.sidebar')

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">

        @include('layouts.header')

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <div class="w-full mt-2">
                    {{ $slot }}
                </div>
            </main>
        </div>

    </div>

    @livewireScripts
    <script>
    Date.prototype.addDays = function (days) {
        const date = new Date(this.valueOf());
        date.setDate(date.getDate() + days);
        return date;
    }
    const formatDate = (date) => {
        let month = (date.getMonth() + 1) + '';
        month = month.length === 2 ? month : '0' + month;
        let day = date.getDate() + '';
        day = day.length === 2 ? day : '0' + day;
        const year = date.getFullYear();
        return year + '-' + month + '-' + day;
    }
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? prefix + '' + rupiah : '');
    }

    window.addEventListener('swal:modal', event => {
        swal.fire(
            event.detail.title,
            event.detail.text,
            event.detail.type,
        );
    });
    </script>
    @isset($script)
        {!! $script !!}
    @endisset
</body>

</html>
