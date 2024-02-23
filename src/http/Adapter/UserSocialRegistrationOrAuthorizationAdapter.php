<?php

namespace Http\Adapter;

use domain\Entities\UserEntity;
use Http\Services\UserService;
use http\DTO\Users\UserRequest;

require_once dirname(__DIR__, 2) . "/domain/Entities/UserEntity.php";
require_once dirname(__DIR__) . "/Services/UserService.php";
require_once dirname(__DIR__) . "/DTO/Users/UserRequest.php";


interface UserSocialRegistrationOrAuthorizationInterface
{
    public function set_cookie(UserRequest $context);
}

class CreateAccount extends UserService implements UserSocialRegistrationOrAuthorizationInterface
{
    public function creation(UserRequest $context): UserEntity
    {
        global $entityManager;
        $obj = new UserEntity;
        $row = $obj($context);
        $entityManager->persist($row);
        $entityManager->flush();
        return $row;
    }
    public function set_cookie(UserRequest $context): UserEntity
    {
        $this->creation($context);
        $user = $this->getByPlatformId($context->platformId);
        setcookie("user_id", $user->id);
        setcookie("user_platform_id", $user->platformId);
        setcookie("user_first_name", $user->firstName);
        setcookie("user_last_name", $user->lastName);
        setcookie("user_platform", $user->platformAuthentication);
        return $user;
    }
}

class AuthAccount extends UserService implements UserSocialRegistrationOrAuthorizationInterface
{
    public function set_cookie(UserRequest $context): UserEntity
    {
        $user = $this->getByPlatformId($context->platformId);
        setcookie("user_id", $user->id);
        setcookie("user_platform_id", $user->platformId);
        setcookie("user_first_name", $user->firstName);
        setcookie("user_last_name", $user->lastName);
        setcookie("user_platform", $user->platformAuthentication);
        return $user;
    }
}
class UserSocialRegistrationOrAuthorizationAdapter extends UserService
{
    public function authorization(UserRequest $context): UserEntity
    {
        if (is_null($this->getByPlatformId($context->platformId)))
        {
            $create_user = new CreateAccount();
            return $create_user->set_cookie($context);
        }
        else
        {
            $auth_user = new AuthAccount();
            return $auth_user->set_cookie($context);
        }
    }
}