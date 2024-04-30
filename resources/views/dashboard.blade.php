<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg rounded px-8 pt-6 pb-8 mb-4">
                {{-- <form action="#" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                  
                </form> --}}
                <div class="mb-4">
                    <x-select label="Recipient" placeholder="Select some user" :template="[
                            'name' => 'user-option',
                            'config' => ['src' => 'profile_image'],
                        ]" option-label="name" option-value="id" option-description="email" >
                        <x-select.user-option  label="André Luiz" value="1" />
                        <x-select.user-option  label="Fernando Gunther" value="2" />
                        <x-select.user-option label="Keithyellen Huhn" value="3" />
                        <x-select.user-option  label="João Pedro" value="4" />
                        <x-select.user-option  label="Pedro Henrique" value="5" />
                </x-select>
                </div>
                <div class="mb-4">
                    <x-textarea label="Notes" placeholder="write your notes" />
                </div>
                <div class="flex items-center justify-between">
                    <x-button warning label="Info" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
