@props(['title' => '', 'bodyClass' => '', 'class'])

<x-base-layout :$title :$bodyClass>
    <main>
        <div class="container-small page-login">
            <div class="flex" style="gap: 5rem">
                <div class="auth-page-form">
                    <div class="text-center">
                        <a href="/">
                            <img src="/img/logoipsum-265.svg" alt="" />
                        </a>
                    </div>
                    <h1 class="auth-page-title">{{ $title }}</h1>

                    {{ $slot }}

                    <div class="grid grid-cols-2 gap-1 social-auth-buttons">
                        <x-google-button />
                        <x-fb-button />
                    </div>

                    <div class="{{ $class }}">
                        {{ $footerLinks }}
                    </div>


                </div>

                <div class="auth-page-image">
                    <img src="/img/car-png-39071.png" alt="" class="img-responsive" />
                </div>
            </div>
        </div>
    </main>

    </x-auth-layout>
