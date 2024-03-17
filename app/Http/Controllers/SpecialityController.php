<?php

namespace App\Http\Controllers;

use App\Interfaces\SpecialityRepositoryInterface;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    private $repository;

    public function __construct(SpecialityRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    function all()
    {
        return $this->repository->all();
    }
}
