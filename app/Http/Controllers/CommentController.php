<?php

namespace App\Http\Controllers;

use App\Interfaces\CommentRepositoryInterface;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $repository;

    public function __construct(CommentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    function getByStandard($idStandard)
    {
        return $this->repository->getByStandard($idStandard);
    }

    function create(Request $request)
    {
        return $this->repository->create($request->all());
    }
}
