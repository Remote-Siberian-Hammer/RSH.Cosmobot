<?php

namespace domain\Entities;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use domain\Extantions\Entities\IntegerIdTrait;
use domain\Extantions\Entities\TimestampDateTrait;

require_once dirname(__DIR__) . "/Extantions/Entities/IntegerIdTrait.php";
require_once dirname(__DIR__) . "/Extantions/Entities/TimestampDateTrait.php";

#[Entity]
#[Table(name: 'bots', options: ['order' => 2])]
class BotEntity
{
    use IntegerIdTrait;
    use TimestampDateTrait;
    #[Column(name: 'owner_id', type: Types::BIGINT)]
    public int $ownerId;
    #[Column(name: 'hash_name', type: Types::STRING, unique: true)]
    public string $hashName;
}