<?php

namespace App\Livewire\Message;

use App\Enum\MessageReadOption;
use App\Models\Message;
use App\Services\MessageService;
use Livewire\Component;
use Illuminate\Support\Facades\URL;
class Create extends Component
{
    public $recipient;
    public $message;
    public $expiry_at;
    public $encryptionKey;

    protected $messageService;

    public function boot(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }
    public function mount() {
        $this->message['read_option'] = MessageReadOption::ONCE->value;
    }

    public function rules() : array{
        return [ 
            'recipient' => 'required',
            'message.message'   => 'required',
            'expiry_at' => 'required_if:message.read_option,==,'.MessageReadOption::CUSTOM->value   
        ];
    }

    public function messages() : array{
        return [ 
            'recipient.required' => 'Recipient is Required',
            'message.message'   => 'Message is Required',
            'expiry_at' => 'Delete Time is Required'  
        ];
    }
    public function render()
    {
        return view('livewire.message.create');
    }

    public function save()
    {
        $this->validate();

        $this->message['recipient_id'] = $this->recipient;
        $this->message['expiry_at'] = $this->expiry_at;
        
        // Set Encryption And Save Message
        $this->messageService->setEncryptionKey()
        ->setMessageData($this->message)
        ->createMessage();
        
        $this->reset();
        $this->message['read_option'] = MessageReadOption::ONCE->value;
        
        // Get Encryption Key
        $this->encryptionKey = $this->messageService->getEncryptionKey();
    }

}
