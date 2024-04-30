<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Message') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg rounded px-8 pt-6 pb-8 mb-4">
                <div  wire:key='{{time()}}' x-data="{ open: {{ $encryptionKey ? 'true' : 'false'}} }">
                    <div x-show="open" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            Please Copy a Encryption Key to Decrypt Message
                            <span class="font-semibold"> {{$this->encryptionKey}}</span>
                        </div>
                        <button type="button"
                            x-on:click="open = ! open"
                            class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                            aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                </div>
               
                <div class="mb-4">
                    <x-select
                        wire:model.live='recipient'
                        label="Recipient"
                        placeholder="Select a recipient"
                        :async-data="route('api.users.index')"
                        option-label="name"
                        option-value="id"
                    />
                </div>
                <div class="mb-4">
                    <x-textarea label="Message" wire:model='message.message' placeholder="Write your message" />
                </div>
                <div class="mb-4">
                    <x-radio id="{{App\Enum\MessageReadOption::ONCE->label()}}" label="{{App\Enum\MessageReadOption::ONCE->label()}}" wire:model.live="message.read_option" value="{{App\Enum\MessageReadOption::ONCE->value}}" />
                </div>
                <div class="mb-4">
                    <x-radio id="{{App\Enum\MessageReadOption::CUSTOM->label()}}" label="{{App\Enum\MessageReadOption::CUSTOM->label()}}" wire:model.live="message.read_option" value="{{App\Enum\MessageReadOption::CUSTOM->value}}" />
                </div>

                @if ($this->message['read_option'] == App\Enum\MessageReadOption::CUSTOM->value)
                    <div class="mb-4">
                        <x-datetime-picker id="default-picker" label="Delete Time" placeholder="Delete Time" wire:model.live="expiry_at" />
                    </div>
                @endif 
                <div class="flex items-center justify-end">
                    <x-button wire:click='save' info label="Send" />
                </div>
            </div>
        </div>
    </div>
</div>
