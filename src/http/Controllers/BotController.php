<?php

namespace Http\Controllers;

use Twig\Environment;

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
}
