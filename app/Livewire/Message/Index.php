<?php

namespace App\Livewire\Message;

use App\Models\Message;
use App\Services\MessageService;
use Exception;
use Livewire\Component;

class Index extends Component
{

    protected $messageService;
    public $message;
    public $modal = false;
    public $decryption_key;
    public $decryptedMessage = null;
    public $decryptedError;




    public function boot(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }
    public function render()
    {
        return view('livewire.message.index');
    }

    public function rules() : array{
        return [ 
            'decryption_key' => 'required',
        ];
    }

    // Get All Messages
    public function getMessagesProperty(){
        return $this->messageService->getMessages();
    }

    public function setMessage(Message $message) {
        $this->reset();
        $this->resetErrorBag();
        $this->message = $message;
        $this->modal   = true;
    }

    public function decryptyMessage() {
        $this->validate();
        try {
            $this->decryptedError = false;

            // Decrypt Message
            $this->decryptedMessage = $this->messageService
                ->setMessage($this->message)
                ->decryptMessage($this->decryption_key);

            // Delete Message 
        $this->messageService
                ->deleteMessage($this->message);
                
        } catch (Exception $e) {
            $this->decryptedError = true;
            $this->decryptedMessage = null;
        }
    }


}
