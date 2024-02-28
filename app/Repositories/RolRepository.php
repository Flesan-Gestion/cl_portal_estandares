<?php

namespace App\Repositories;

use App\Interfaces\RolRepositoryInterface;
use App\Models\Rol;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class RolRepository implements RolRepositoryInterface
{


    protected $model;

    public function __construct(Rol $model)
    {
        $this->model = $model;
    }

    function getById($id)
    {
        return $this->model->where('id_rol', $id)->first();
    }
}
