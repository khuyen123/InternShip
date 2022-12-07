<?php
namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function getAll();
    public function changePass($request, User $user);
}