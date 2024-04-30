<?php
namespace App\Repository\Eloquent;

use App\Models\Message;
use App\Repository\Contracts\MessageRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{

   /**
    * MessageRepository constructor.
    *
    * @param Message $model
    */
   public function __construct(Message $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function get(): Collection
   {
        return $this->model
            ->where('recipient_id',Auth::id())
            ->orderBy('created_at','DESC')
            ->get();    
   }

   
}