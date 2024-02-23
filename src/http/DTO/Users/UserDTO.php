<?php

namespace http\DTO\Users;

final class UserDTO
{
    public int $id;
    public int $platformId;
    public string $platformAuthentication;
    public string $firstName;
    public string $lastName;
    public string $hashKey;
    public \DateTime $created_date;
    public \DateTime $updated_date;
}