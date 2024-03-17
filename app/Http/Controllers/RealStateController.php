<?php

namespace App\Http\Controllers;

use App\Interfaces\RealEstateRepositoryInterface;
use Illuminate\Http\Request;

class RealStateController extends Controller
{
    private $repository;

    public function __construct(RealEstateRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    function all()
    {
        return $this->repository->all();
    }
}
