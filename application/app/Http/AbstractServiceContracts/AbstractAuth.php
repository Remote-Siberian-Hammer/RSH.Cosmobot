<?php

namespace App\Http\AbstractServiceContracts;
use Illuminate\Http\RedirectResponse;
use App\Http\Contracts\Factory\AbstractAuthFactory;
use App\Models\User;

abstract class AbstractAuth
{
    abstract public function authenticate_redirect();
    abstract public function authenticate_callback();
}
