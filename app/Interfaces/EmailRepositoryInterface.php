<?php

namespace App\Interfaces;

interface EmailRepositoryInterface
{
    public function sendEmailNewComment($id);
}
