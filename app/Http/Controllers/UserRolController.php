<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRolRepositoryInterface;
use Illuminate\Http\Request;

class UserRolController extends Controller
{
    private $repository;

    public function __construct(UserRolRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    function create(Request $request)
    {
        return $this->repository->create($request->all());
    }

    function updateRol(Request $request, $id)
    {
        return $this->repository->update($id, array("id_rol" => $request->all()['rol']));
    }
}
