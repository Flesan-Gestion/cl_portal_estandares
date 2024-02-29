<?php

namespace App\Http\Controllers;

use App\Interfaces\RolRepositoryInterface;
use Illuminate\Http\Request;

class RolController extends Controller
{
    private $repository;

    public function __construct(RolRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    function all(){
        return $this->repository->all();
    }
}
