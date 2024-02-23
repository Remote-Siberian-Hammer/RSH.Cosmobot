<?php

namespace domain\Extantions\Entities;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;


trait TimestampDateTrait
{
    #[GeneratedValue(strategy: 'SEQUENCE')]
    #[Column(name: 'created_date',
        type: Types::DATETIME_MUTABLE,
        nullable: true,
        options: ["default" => "CURRENT_TIMESTAMP"])]
    public \DateTime $created_date;
}