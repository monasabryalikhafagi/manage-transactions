<?php

namespace  App\Repositories;

use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class UserRepository extends Repository
{
    public function __construct(User $user)
    {
        $this->setModel($user);
    }

}
