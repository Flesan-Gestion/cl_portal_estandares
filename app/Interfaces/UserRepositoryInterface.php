<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    function getUserByEmail($email);

    function getUserByEmailForComments($email);
    
    function getUsers();

    function findById(
        int $modelId,
        array $columns = ['*'],
        array $relations = []
    ): ?Model;

    function create(array $payload): ?Model;

    function update(int $modelId, array $payload): bool;

}
