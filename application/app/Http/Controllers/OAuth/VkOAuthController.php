<?php

namespace App\Http\Controllers\OAuth;

use App\Http\Controllers\Controller;
use App\Http\Services\AuthUserService;
use App\Http\Services\VkFactory;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class VkOAuthController extends Controller
{
    protected AuthUserService $_authUserService;
    public function __construct(AuthUserService $authUserService)
    {
        $this->_authUserService = $authUserService;
    }

    public function redirect(Request $request)
    {
        return $this->_authUserService::authenticate_redirect(new VkFactory());
    }

    public function handle_callback(Request $request)
    {
        //TODO: Сделать добавление юзера и авторизацию
        return $this->_authUserService::authenticate_callback(new VkFactory());
    }
}
