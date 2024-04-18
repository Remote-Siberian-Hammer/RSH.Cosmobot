<?php

namespace Repository;
use Models\Dom;

class DomCacheRepository
{
    public function cache($documentManager, string $ip, string $dom)
    {
        $domDocument = new Dom();

        $domDocument->setIp($ip);
        $domDocument->setDom($dom);

        $documentManager->persist($domDocument);
        $documentManager->flush();
    }
}

?>