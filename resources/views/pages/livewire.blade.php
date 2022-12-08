<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Livewire') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-xl bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <livewire:message-form />
            </div>
        </div>
    </div>
</x-app-layout>
