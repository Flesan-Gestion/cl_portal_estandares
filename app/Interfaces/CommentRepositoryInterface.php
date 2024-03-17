<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface CommentRepositoryInterface extends EssentialRepositoryInterface
{

    function getByStandard($idStandard);
}
