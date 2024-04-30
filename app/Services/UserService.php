<?php
namespace App\Services;

use App\Repository\Eloquent\UserRepository;
use Illuminate\Support\Collection;

class UserService
{
    protected $userRepository;
    protected $search;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param $value
     */
    public function setSearchValue($value){
        $this->search = $value;
        return $this;
    }

    /**
    * @return Collection
    */
    public function getAllUsers() {
        return $this->userRepository->get($this->search);
    }

}