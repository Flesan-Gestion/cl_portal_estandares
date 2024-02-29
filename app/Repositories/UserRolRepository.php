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

    public function findById(
        int $modelId,
        array $columns = ['*'],
        array $relations = []
    ): ?Model {
        return $this->model->select($columns)->with($relations)->orderByDesc($this->model->getKeyName())->findOrFail($modelId);
    }

    public function create(array $payload): ?Model
    {
        $model = $this->model->create($payload);
        return $model->fresh();
    }


    public function update(int $modelId, array $payload): bool
    {
        $model = $this->findById($modelId);

        return $model->update($payload);
    }

}
