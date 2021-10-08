@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600">
            {{ __('Login Gagal!') }}
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            <li>Email / username dan password tidak sesuai</li>
        </ul>
    </div>
@endif
