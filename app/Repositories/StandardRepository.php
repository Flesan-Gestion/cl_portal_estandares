<?php

namespace App\Repositories;

use App\Interfaces\StandardRepositoryInterface;
use App\Models\Standard;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StandardRepository extends EssentialRepository implements StandardRepositoryInterface
{

    protected $model;

    public function __construct(Standard $model)
    {
        $this->model = $model;
    }
}
