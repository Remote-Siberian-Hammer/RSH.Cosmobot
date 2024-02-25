<?php
namespace Http\Factory;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Http\Adapter\UserSocialRegistrationOrAuthorizationAdapter;
use Http\DTO\Users\UserRequest;
use Http\DTO\Users\UserByHashKeyDTO;
use domain\Entities\UserEntity;

require_once dirname(__DIR__) . '/DTO/Users/UserRequest.php';
require_once dirname(__DIR__) . '/DTO/Users/UserByHashKeyDTO.php';
require_once dirname(__DIR__, 2) . '/domain/Entities/UserEntity.php';
require_once dirname(__DIR__) . '/Adapter/UserSocialRegistrationOrAuthorizationAdapter.php';
require_once dirname(__DIR__, 2) . "/config/bootstrap.php";


interface AuthSocialInterfaceFactory
{
    public function oauthCallback(array $callback_data);
}
interface UserAuthInterfaceFactory
{
    public function isAuthUser();
    public function setCookie();
}

readonly class SocialTelegramFactory implements AuthSocialInterfaceFactory, UserAuthInterfaceFactory
{
    public function oauthCallback(array $callback_data): AuthSocialTelegram { return new AuthSocialTelegram(); }
    public function isAuthUser(): AuthSocialTelegram { return new AuthSocialTelegram(); }
    public function setCookie(): AuthSocialTelegram { return new AuthSocialTelegram(); }
}

readonly class SocialVkFactory implements AuthSocialInterfaceFactory, UserAuthInterfaceFactory
{
    public function oauthCallback(array $callback_data): AuthSocialVk { return new AuthSocialVk(); }
    public function isAuthUser(): AuthSocialVk { return new AuthSocialVk(); }
    public function setCookie(): AuthSocialVk { return new AuthSocialVk(); }
}



interface SocialInterface {
    public function auth(UserRequest $context): UserEntity;
}

final class AuthSocialTelegram implements SocialInterface
{
    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function auth(UserRequest $context): UserEntity
    {
        $adapter = new UserSocialRegistrationOrAuthorizationAdapter();
        return $adapter->authorization($context);
    }
}

final class AuthSocialVk implements SocialInterface
{
    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function auth(UserRequest $context): UserEntity
    {
        $adapter = new UserSocialRegistrationOrAuthorizationAdapter();
        return $adapter->authorization($context);
    }
}