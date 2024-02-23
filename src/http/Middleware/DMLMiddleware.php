<?php

namespace Http\Middleware;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;

require_once dirname(__DIR__, 2) . "/config/bootstrap.php";

class DMLMiddleware
{
    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function __invoke(): void
    {
        //TODO: Настроить мидлвару
        global $entityManager;
        $entityManager->flush();
    }
}