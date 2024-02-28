<?php

namespace App\Repositories;

use App\Interfaces\EssentialRepositoryInterface;
use App\Interfaces\UserRolRepositoryInterface;
use App\Models\UserRol;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRolRepository implements UserRolRepositoryInterface
{

    protected $model;

    public function __construct(UserRol $model)
    {
        $this->model = $model;
    }
}
