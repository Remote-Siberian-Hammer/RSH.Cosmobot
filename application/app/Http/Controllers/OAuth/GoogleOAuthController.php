<?php

namespace App\Http\Controllers\OAuth;

use App\Http\Controllers\Controller;
use App\Http\Services\AuthUserService;
use App\Http\Services\GoogleFactory;
use Illuminate\Http\Request;

class GoogleOAuthController extends Controller
{
    protected AuthUserService $_authUserService;
    public function __construct(AuthUserService $authUserService)
    {
        $this->_authUserService = $authUserService;
    }

    public function redirect(Request $request)
    {
        return $this->_authUserService::authenticate_redirect(new GoogleFactory());
    }

    public function handle_callback(Request $request)
    {
        //TODO: Сделать добавление юзера и авторизацию
        $this->_authUserService::authenticate_callback(new GoogleFactory());
        return redirect()->route('home');
    }
}
