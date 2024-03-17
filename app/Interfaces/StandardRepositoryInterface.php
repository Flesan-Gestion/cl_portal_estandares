<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface StandardRepositoryInterface extends EssentialRepositoryInterface
{
    function allViewer();

    function allAdministrator();

    function generateCode($idSpeciality);

    function enable($id, $user_update);

    function disable($id, $user_update);
}
