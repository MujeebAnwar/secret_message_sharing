<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Message') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg rounded px-8 pt-6 pb-8 mb-4">
                <div class="w-96 text-surface dark:text-white">
                    @forelse ($this->messages as $message)
                        <div class="w-full border-b-2 border-neutral-100 py-4 dark:border-white/10 flex items-center justify-between">
                            <p>{{ $message->sender->name }} sent you a new message.</p>
                            <x-button flat wire:click="setMessage('{{$message->id}}')">
                                <x-icon name="eye" class="w-5 h-5" />
                            </x-button>
                        </div>
                    @empty
                        <div class="">
                            <p>No messages found.</p>
                        </div>
                    @endforelse
                    
                </div>
            </div>
        </div>
    </div>

    {{-- Modal to Decrypt Message --}}
    <x-modal.card  blur wire:model.defer="modal">

        @if($decryptedError)
            <div>
                <div class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
                    <span class="sr-only">Dander</span>
                    <div class="ms-3 text-sm font-medium">
                        Unable to Decrypt Message
                    </div>
                </div>
            </div>
        @endif
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <x-input label="Decryption Key" placeholder="Decryption Key" wire:model='decryption_key' />    
        </div>
        @if($this->decryptedMessage)
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-3">
                <x-textarea label="Message" readonly>
                    {{$this->decryptedMessage}}
                </x-textarea>    
            </div>
        @endif
        <div class="flex justify-between gap-x-4 mt-3">     
            <div class="flex">
                <x-button primary label="Decrypt" wire:click="decryptyMessage" />
            </div>
        </div> 
    </x-modal.card>
</div>
