<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Services\UserService;
use Illuminate\Http\Response;

class UserController extends Controller
{
    //

    private $userService;
  
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index() {

        /**
         * @return \Illuminate\Database\Eloquent\Collection
         * 
         */
        $users = $this->userService
        ->setSearchValue(request()->search)
        ->getAllUsers();
        return response()->json($users,Response::HTTP_OK);
    }
}
