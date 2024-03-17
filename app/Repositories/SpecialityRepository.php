<?php

namespace App\Repositories;

use App\Interfaces\SpecialityRepositoryInterface;
use App\Models\Speciality;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SpecialityRepository extends EssentialRepository implements SpecialityRepositoryInterface
{

    protected $model;

    public function __construct(Speciality $model)
    {
        $this->model = $model;
    }
}
