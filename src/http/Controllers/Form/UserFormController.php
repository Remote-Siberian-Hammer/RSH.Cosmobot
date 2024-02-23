<?php

namespace Http\Controllers\Form;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use domain\Entities\UserEntity;
use http\DTO\Users\UserRequest;
use Http\Factory\AuthSocialTelegram;
use Http\Factory\AuthSocialVk;

class UserFormController
{
    private AuthSocialTelegram $_authSocialTelegram;
    private AuthSocialVk $_authSocialVk;

    public function __construct(AuthSocialTelegram $authSocialTelegram, AuthSocialVk $authSocialVk)
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
        if ($this->_authSocialTelegram->auth($row))
        {
            header("Location: /");
            exit();
        }
        header("Location: /?error_mode=auth");
        exit();
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
        if ($this->_authSocialVk->auth($row))
        {
            header("Location: /");
            exit();
        }
        header("Location: /?error_mode=auth");
        exit();
    }
}