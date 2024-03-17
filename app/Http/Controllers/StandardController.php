<?php

namespace App\Http\Controllers;

use App\Interfaces\StandardRepositoryInterface;
use App\Models\Standard;
use Illuminate\Http\Request;

class StandardController extends Controller
{

    private $repository;

    public function __construct(StandardRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    function allViewer()
    {
        return $this->repository->allViewer();
    }

    function allAdministrator()
    {
        return $this->repository->allAdministrator();
    }

    function create(Request $request)
    {
        return $this->repository->create($request->all());
    }

    function update(Request $request, $id)
    {
        return $this->repository->update($id, $request->all());
    }

    function enable(Request $request, $id)
    {
        return $this->repository->enable($id, $request->all()['user']);
    }

    function disable(Request $request, $id)
    {
        return $this->repository->disable($id, $request->all()['user']);
    }

    function generateCode($idSpeciality)
    {
        return $this->repository->generateCode($idSpeciality);
    }
}
