<?php

namespace http\Controllers;

use Twig\Environment;

class MailingController
{
    private Environment $_view;
    public function __construct(Environment $view)
    {
        $this->_view = $view;
    }
    public function index()
    {
        return $this->_view->render('mailing/index.twig', []);
    }
    public function show()
    {
        return $this->_view->render('mailing/show.twig', []);
    }
}