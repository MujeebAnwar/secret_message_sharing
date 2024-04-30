<?php
namespace App\Repository\Contracts;

use App\Model\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
   public function get(): Collection;
}