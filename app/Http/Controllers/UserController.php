<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    function getUsers()
    {
        return $this->repository->getUsers();
    }

    function enable($id)
    {
        return $this->repository->update($id, array(
            "estado_sesion" => 1
        ));
    }

    function disable($id)
    {
        return $this->repository->update($id, array(
            "estado_sesion" => 0
        ));
    }

}
