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

    function all()
    {
        return $this->repository->all();
    }

    function create(Request $request)
    {
        return $this->repository->create($request->all());
    }

    function update(Request $request, $id)
    {
        return $this->repository->update($id, $request->all());
    }

    function saveComment(Request $request, $id)
    {
        return $this->repository->update($id, array(
            "comentarios" => $request->all()['comment'],
            "user_update" => $request->all()['user'],
            "user_comment" => $request->all()['user'],
        ));
    }

    function delete(Request $request, $id)
    {
        return $this->repository->update($id, array("enable" => 0, "user_update" => $request->all()['user']));
    }
}
