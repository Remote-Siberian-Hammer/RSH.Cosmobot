<?php

namespace http\DTO\Users;

final class UserRequest
{
    public int $platformId;
    public string $platformAuthentication;
    public string $firstName;
    public string $lastName;
    public string $hashKey;

    public function __invoke(array $param): UserRequest
    {

        $obj = $this;
        $obj->platformId = $param['platform_id'];
        $obj->platformAuthentication = $param['platform_authentication'];
        $obj->firstName = $param['first_name'];
        $obj->lastName = $param['last_name'];
        $obj->hashKey = $param['hash_key'];
        return $obj;
    }
}