@props(['title' => '', 'footerLinks' => '', 'bodyClass' => null])

<x-base-layout :$title :$bodyClass>

    <x-layouts.header />
    @if (session('error'))
        <div class="bg-red-500 text-gray-600 bold m-auto py-2 px-3 text-base">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-500 text-gray-600 bold m-auto py-2 px-3 text-base">
            {{ session('success') }}
        </div>
    @endif

    {{ $slot }}

</x-base-layout>
