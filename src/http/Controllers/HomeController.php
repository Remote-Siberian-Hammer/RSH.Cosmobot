<?php

namespace Http\Controllers;

use Twig\Environment;


class HomeController
{
    private Environment $_view;
    public function __construct(Environment $view)
    {
        $this->_view = $view;
    }
    public function index()
    {
        return $this->_view->render('index.twig', []);
    }
}