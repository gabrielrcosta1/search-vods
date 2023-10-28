@extends('layouts.app')
@section('content')
    <main>

        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <div class="isolate bg-white px-6 py-24 sm:py-32 lg:px-8">

                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Pesquisa de Séries/Novelas</h2>
                    <p class="mt-2 text-lg leading-8 text-gray-600">Algumas séries podem estar com nome em português</p>
                </div>
                <div class="mx-auto mt-16 max-w-xl sm:mt-20">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">

                        @livewire('serie-search')

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
