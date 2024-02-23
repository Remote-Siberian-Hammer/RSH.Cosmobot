<?php

namespace http\DTO\Users;

final class UserByHashKeyDTO
{
    public string $hashKey;

    public function __invoke(array $param): void
    {
        $this->hashKey = $param['hash_key'];
    }
}