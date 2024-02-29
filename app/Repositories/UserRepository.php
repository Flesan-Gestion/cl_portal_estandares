<?php

namespace App\Repositories;

use App\Interfaces\EssentialRepositoryInterface;
use App\Interfaces\RolRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\UserRolRepositoryInterface;
use App\Models\Rol;
use App\Models\User;
use App\Models\UserRol;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements UserRepositoryInterface
{
    protected $model;
    protected $repositoryRol;

    public function __construct(User $model, RolRepositoryInterface $repositoryRol)
    {
        $this->model = $model;
        $this->repositoryRol = $repositoryRol;
    }

    function getUserByEmail($email)
    {
        $user = $this->model->with('usuarioRols')
            ->whereRaw('UPPER(username) = ?', [strtoupper($email)])
            ->where('id_aplicacion', env('ID_APLICACION'))
            ->where('estado_sesion', 1)
            ->first(['id_aplicacion_usuario', 'username', 'name', 'estado_sesion', 'dni', 'nombres', 'apellidos', 'pais', 'avatar']);
        if ($user == null) return null;
        $rol = $this->repositoryRol->getById($user->usuarioRols[0]->id_rol);
        $user->rol = $rol;
        unset($user->usuarioRols);
        return $user;
    }

    function getUsers()
    {
        $users = $this->model->with('usuarioRols')
            ->where('id_aplicacion', env('ID_APLICACION'))
            ->get(['id_aplicacion_usuario', 'username', 'name', 'estado_sesion', 'dni', 'nombres', 'apellidos', 'pais', 'avatar']);
        foreach ($users as $key => $value) {
            $rol = $this->repositoryRol->getById($value->usuarioRols[0]->id_rol);
            $users[$key]['rol'] = $rol;
        }
        return $users;
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
        $payload['id_aplicacion'] = env('ID_APLICACION');
        $model = $this->model->create($payload);
        return $model->fresh();
    }


    public function update(int $modelId, array $payload): bool
    {
        $model = $this->findById($modelId);

        return $model->update($payload);
    }
}
