<?php

namespace App\Http\Controllers;

use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\EmailRepositoryInterface;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $repository;

    private $repositoryEmail;

    public function __construct(CommentRepositoryInterface $repository, EmailRepositoryInterface $repositoryEmail)
    {
        $this->repository = $repository;
        $this->repositoryEmail = $repositoryEmail;
    }

    function getByStandard($idStandard)
    {
        return $this->repository->getByStandard($idStandard);
    }

    function create(Request $request)
    {
        $comment = $this->repository->create($request->all());

        $this->repositoryEmail->sendEmailNewComment($comment['cm_id']);
        
        return $comment;
    }
}
