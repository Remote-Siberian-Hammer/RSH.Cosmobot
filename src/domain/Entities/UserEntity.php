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
#[Table(name: 'users', options: ['order' => 1])]
final class UserEntity
{
    use IntegerIdTrait;
    use TimestampDateTrait;
    #[Column(name: 'platform_id', type: Types::BIGINT, unique: true)]
    public int $platformId;
    #[Column(name: 'platform_authentication', options: ["check" => ['Вконтакте', 'Телеграм']],)]
    public string $platformAuthentication;
    #[Column(name: 'first_name', type: Types::STRING, nullable: true)]
    public string $firstName;
    #[Column(name: 'last_name', type: Types::STRING, nullable: true)]
    public string $lastName;
    #[Column(name: 'hash_key', type: Types::STRING, unique: true)]
    public string $hashKey;

    public function __invoke($cls): UserEntity
    {
        $obj = $this;
        $obj->platformId = $cls->platformId;
        $obj->platformAuthentication = $cls->platformAuthentication;
        $obj->firstName = $cls->firstName;
        $obj->lastName = $cls->lastName;
        $obj->hashKey = $cls->hashKey;
        $obj->created_date = new \DateTime(date("d.m.Y G:i:s"));
        return $obj;
    }
}