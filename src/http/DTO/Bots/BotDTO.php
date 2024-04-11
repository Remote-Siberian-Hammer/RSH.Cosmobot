<?php

namespace http\DTO\Bots;

final class BotDTO
{
    public int $id;
    public int $ownerId;
    public string $hashName;
    public \DateTime $createdDate;
}