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
}
