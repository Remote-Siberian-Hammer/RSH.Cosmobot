<?php

namespace Http\Controllers;

use domain\Entities\BotEntity;
use Twig\Environment;

require_once dirname(__DIR__, 2) . "/config/bootstrap.php";
require_once dirname(__DIR__, 2) . '/domain/Entities/BotEntity.php';
class BotController
{
    private Environment $_view;

    public function __construct(Environment $view)
    {
        $this->_view = $view;
    }

    public function get_creator()
    {
        return $this->_view->render('bot/constructor.twig', []);
    }

    public function bot_list() {
        global $entityManager;
        return $this->_view->render('bot/my_bots.twig', [
            'KEY' => $entityManager->getRepository(BotEntity::class)->findAll()
        ]);
    }

    public function details(array $context) {
        global $entityManager;
        return $this->_view->render('bot/details.twig', [
            'BOT' => $entityManager->getRepository(BotEntity::class)->findOneBy(["id" => $context['id']])
        ]);
    }
}
