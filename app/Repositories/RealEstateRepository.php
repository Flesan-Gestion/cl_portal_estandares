<?php

namespace App\Repositories;

use App\Interfaces\RealEstateRepositoryInterface;
use App\Models\RealEstate;

class RealEstateRepository extends EssentialRepository implements RealEstateRepositoryInterface
{

    protected $model;

    public function __construct(RealEstate $model)
    {
        $this->model = $model;
    }
}
