<?php

namespace Http\Services;

use domain\Entities\UserEntity;
use domain\SeviceContracts\UserServiceInterface;

require_once dirname(__DIR__, 2) . "/config/bootstrap.php";
require_once dirname(__DIR__, 2) . '/domain/Entities/UserEntity.php';
require_once dirname(__DIR__, 2) . '/domain/SeviceContracts/UserServiceInterface.php';


class UserService implements UserServiceInterface
{
    protected string $pathUserEntity;
    public function __construct()
    {
        $this->pathUserEntity = dirname(__DIR__, 2) . "/domain/Entities/UserEntity.php";
    }
    public function getByPlatformId(int $platform_id): UserEntity|null
    {
        global $entityManager;
        return $entityManager->getRepository("domain\Entities\UserEntity")
            ->findOneBy(["platformId" => $platform_id]);
    }
}