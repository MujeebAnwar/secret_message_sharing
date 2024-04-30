<?php 

namespace App\Providers;

use App\Repository\Contracts\EloquentRepositoryInterface;
use App\Repository\Contracts\MessageRepositoryInterface;
use App\Repository\Eloquent\UserRepository; 
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Repository\Eloquent\MessageRepository;
use Illuminate\Support\ServiceProvider; 

/** 
* Class RepositoryServiceProvider 
* @package App\Providers 
*/ 
class RepositoryServiceProvider extends ServiceProvider 
{ 
   /** 
    * Register services. 
    * 
    * @return void  
    */ 
   public function register() 
   { 
       $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
       $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
       $this->app->bind(MessageRepositoryInterface::class, MessageRepository::class);
   }
}