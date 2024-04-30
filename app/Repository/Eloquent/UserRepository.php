<?php
namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\Contracts\UserRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

   /**
    * UserRepository constructor.
    *
    * @param User $model
    */
   public function __construct(User $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function get($search = null): Collection
   {
        return $this->model
            // ->where('id','<>',Auth::id())
            ->when($search, function (Builder $query, string $search) {
                $search = "%{$search}%";
                return $query->where('name', 'like', $search)
                    ->orWhere('email', 'like', $search);
            })
            ->get();    
   }
}