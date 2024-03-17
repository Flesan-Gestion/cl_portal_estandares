<?php

namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Comment;

class CommentRepository extends EssentialRepository implements CommentRepositoryInterface
{

    protected $model;

    protected $repositoryUser;

    public function __construct(Comment $model, UserRepositoryInterface $repositoryUser)
    {
        $this->model = $model;
        $this->repositoryUser = $repositoryUser;
    }

    function getByStandard($idStandard)
    {
        $comments = $this->model->where('cm_standard_id', $idStandard)->orderBy('created_at', 'desc')->get();
        foreach ($comments as $key => $value) {
            $user = $this->repositoryUser->getUserByEmailForComments($value->user_create);
            $comments[$key]['user'] = $user;
        }
        return $comments;
    }
}
