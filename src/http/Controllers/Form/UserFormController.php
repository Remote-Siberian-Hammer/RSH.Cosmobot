<?php

namespace Http\Controllers\Form;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use domain\Entities\UserEntity;
use http\DTO\Users\UserRequest;
use Http\Factory\SocialTelegramFactory;
use Http\Factory\SocialVkFactory;

class UserFormController
{
    private SocialTelegramFactory $_authSocialTelegram;
    private SocialVkFactory $_authSocialVk;

    public function __construct(SocialTelegramFactory $authSocialTelegram, SocialVkFactory $authSocialVk)
    {
        $this->_authSocialTelegram = $authSocialTelegram;
        $this->_authSocialVk = $authSocialVk;
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function telegram_callback(array $callback_data): void
    {
        $obj = new UserRequest;
        $row = $obj([
            'platform_id' => $callback_data['id'],
            'platform_authentication' => 'Телеграм',
            'first_name' => $callback_data['first_name'],
            'last_name' => $callback_data['last_name'],
            'hash_key' => $callback_data['hash'],
        ]);
        if (get_class($this->_authSocialTelegram->setCookie()->auth($row)) == UserEntity::class)
        {
            var_dump(UserEntity::class);
            header("Location: /");
            exit();
        }
        else
        {
            header("Location: /?error_mode=auth");
            exit();
        }
    }
    public function vk_callback(array $callback_data): void
    {
        $obj = new UserRequest;
        $row = $obj([
            'platform_id' => $callback_data['uid'],
            'platform_authentication' => 'Вконтакте',
            'first_name' => $callback_data['first_name'],
            'last_name' => $callback_data['last_name'],
            'hash_key' => $callback_data['hash'],
        ]);
        if ($this->_authSocialVk->setCookie()->auth($row))
        {
            header("Location: /");
            exit();
        }
        header("Location: /?error_mode=auth");
        exit();
    }

    public function logout(): void
    {
        setcookie('user_id', '', -1, "/");
        setcookie('user_platform_id', '', -1, "/");
        setcookie('user_first_name', '', -1, "/");
        setcookie('user_last_name', '', -1, "/");
        setcookie('user_platform', '', -1, "/");
        header("Location: /");
        exit();
    }
}