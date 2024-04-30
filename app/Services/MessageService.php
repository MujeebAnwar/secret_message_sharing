<?php
namespace App\Services;

use App\Enum\MessageReadOption;
use App\Repository\Eloquent\MessageRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Auth;

class MessageService
{
    protected $messageRepository;
    protected $encryptionKey;
    protected $message;
    protected $messageData;


    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    // Set Encryption Key for Message

    public function setEncryptionKey()
    {
        $this->encryptionKey = (string) Str::random(32);
        return $this;
    }

    // Get Encryption Key for Message
    public function getEncryptionKey()
    {
        return $this->encryptionKey;
    }


    // Set Message For Descryption
    public function setMessage($message) {
        $this->message = $message;   
        return $this;
    }

    /**
     * Decrypt Message Aginst Key
     * @return $message
    */
    public function decryptMessage($decryptionKey) {
        $encryption = new Encrypter($decryptionKey,'aes-256-cbc');
        return $encryption->decryptString($this->message->message);
    }
    public function setMessageData(array $data){
        $encryption = new Encrypter($this->encryptionKey,'aes-256-cbc');
        $this->messageData  = $data;
        $this->messageData['message']    = $encryption->encryptString($data['message']);
        $this->messageData['sender_id']  = Auth::id();
        return $this;
    }

    /**
    * @param array $attributes
    *
    * @return Model
    */
    public function createMessage() {
        return $this->messageRepository->create($this->messageData);
    }

    /**
     * Return All Messages
    * @return Collection
    */
    public function getMessages() {
        return $this->messageRepository->get();
    }

    /**
     * Delete Message If it's Decrypted For Once Read
     */

     public function deleteMessage() {
        if($this->message->read_option->value == MessageReadOption::ONCE->value){
            return $this->messageRepository->delete($this->message);
        }
     }
    

}