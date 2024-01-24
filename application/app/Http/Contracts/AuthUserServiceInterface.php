<?php

namespace App\Http\Contracts;
use App\Http\Contracts\Factory\AbstractAuthFactory;

interface AuthUserServiceInterface
{
    public static function authenticate_redirect(AbstractAuthFactory $authFactory);
    public static function authenticate_callback(AbstractAuthFactory $authFactory);
}
