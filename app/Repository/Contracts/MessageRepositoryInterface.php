<?php
namespace App\Repository\Contracts;

use App\Model\User;
use Illuminate\Support\Collection;

interface MessageRepositoryInterface
{
   public function get(): Collection;
}