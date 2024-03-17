<?php

namespace App\Repositories;

use App\Interfaces\PrefixCodeRepositoryInterface;
use App\Models\PrefixCode;

class PrefixCodeRepository extends EssentialRepository implements PrefixCodeRepositoryInterface
{

    protected $model;

    public function __construct(PrefixCode $model)
    {
        $this->model = $model;
    }
}
