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

    protected $repositorySpeciality;

    public function __construct(Standard $model, SpecialityRepository $repositorySpeciality)
    {
        $this->model = $model;
        $this->repositorySpeciality = $repositorySpeciality;
    }

    function allViewer()
    {
        return $this->model->with(['speciality', 'realEstate'])->where('enable', '1')->orderBy('st_code', 'asc')->get();
    }

    function allAdministrator()
    {
        return $this->model->with(['speciality', 'realEstate'])->orderBy('st_code', 'asc')->get();
    }

    function generateCode($idSpeciality)
    {
        $speciality = $this->repositorySpeciality->findById($idSpeciality, ['*'], ['prefixCode']);

        $prefixCode = $speciality->prefixCode->pc_description;

        $lastStandard = $this->model->where('st_code', 'LIKE', $prefixCode . '%')->orderBy('st_code_number', 'desc')->first();
        
        if ($lastStandard == null) {
            return $prefixCode . '-001';
        }

        $lastCodeSeparate = explode('-', $lastStandard->st_code);

        $newCodeNumber = intval($lastCodeSeparate[1]) + 1;

        $newCodeNumberFormated =  sprintf("%03d", $newCodeNumber);

        return $prefixCode . '-' . $newCodeNumberFormated;
    }

    function enable($id, $user_update)
    {
        $model = $this->model->findOrFail($id);

        return $model->update(array("enable" => 1, "user_update" => $user_update));
    }

    function disable($id, $user_update)
    {
        $model = $this->model->findOrFail($id);

        return $model->update(array("enable" => 0, "user_update" => $user_update));
    }
}
