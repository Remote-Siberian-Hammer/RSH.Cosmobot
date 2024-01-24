<?php

namespace App\Http\Services;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Http\Contracts\AuthUserServiceInterface;
use App\Http\Contracts\Factory\AbstractAuthFactory;
use App\Http\AbstractServiceContracts\AbstractAuth;
use App\Models\User;

class GoogleFactory implements AbstractAuthFactory
{
    public function createAuth(): AbstractAuth
    {
        return new GoogleAuth();
    }
}

// TODO: Конкретная фабрика для авторизации через ВКонтакте
class VkFactory implements AbstractAuthFactory
{
    public function createAuth(): AbstractAuth
    {
        return new VkAuth();
    }
}

// TODO: Конкретный класс авторизации через Google
class GoogleAuth extends AbstractAuth
{
    public function authenticate_redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function authenticate_callback()
    {
        $oauth = Socialite::driver('google')->stateless()->user();
        try
        {
            $user = new User();
            $user->google_id = $oauth->user['id'];
            $user->first_name = $oauth->user['given_name'];
            $user->last_name = $oauth->user['family_name'];
            $user->email = $oauth->user['email'];
            $user->token_platform = $oauth->token;
            $user->save();
        }
        catch (\Illuminate\Database\UniqueConstraintViolationException $e)
        {
            $user = User::where('google_id', $oauth->user['id'])->first();
        }
        Auth::login($user);
    }
}

// TODO: Конкретный класс авторизации через ВКонтакте
class VkAuth extends AbstractAuth
{
    public function authenticate_redirect()
    {
        return Socialite::driver('vkontakte')->redirect();
    }

    public function authenticate_callback()
    {
        $oauth = Socialite::driver('vkontakte')->stateless()->user();
    }
}

final class AuthUserService implements AuthUserServiceInterface
{
    public static function authenticate_redirect(AbstractAuthFactory $authFactory)
    {
        $auth = $authFactory->createAuth();
        return $auth->authenticate_redirect();
    }

    public static function authenticate_callback(AbstractAuthFactory $authFactory)
    {
        $auth = $authFactory->createAuth();
        return $auth->authenticate_callback();
    }

    public static function authenticate_check()
    {
        return Auth::check();
    }
}
