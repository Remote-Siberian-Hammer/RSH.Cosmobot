<?php

namespace http\Controllers;

use Twig\Environment;


class UserController
{
    private Environment $_view;
    public function __construct(Environment $view)
    {
        $this->_view = $view;
    }
    public function login()
    {
        return $this->_view->render('user/login.twig', []);
    }
}