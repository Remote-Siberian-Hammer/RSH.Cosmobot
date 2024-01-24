<?php

namespace App\Http\Contracts\Factory;
use App\Http\AbstractServiceContracts\AbstractAuth;

interface AbstractAuthFactory
{
    public function createAuth(): AbstractAuth;
}
