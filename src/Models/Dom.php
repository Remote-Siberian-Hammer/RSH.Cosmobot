<?php

namespace Models;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document(db="dom_cache", collection="doc_object_models") */
class Dom
{
    /** @ODM\Id(type="string") */
    private $id;

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }


    /** @ODM\Field(type="string") */
    private $ip;

    public function setIp(string $ip): void
    {
        $this->ip = $ip;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    
    /** @ODM\Field(type="string") */
    private $dom;

    public function setDom(string $dom): void
    {
        $this->dom = $dom;
    }

    public function getDom(): string
    {
        return $this->dom;
    }
}

?>