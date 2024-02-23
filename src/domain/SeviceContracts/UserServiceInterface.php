<?php

namespace domain\SeviceContracts;

interface UserServiceInterface
{
    public function getByPlatformId(int $platform_id);
}