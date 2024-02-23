<?php

use DI\Container;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Http\Factory\AuthSocialTelegram;
use Http\Factory\AuthSocialVk;
use Http\Controllers\BotController;
use Http\Controllers\HomeController;
use Http\Controllers\UserController;
use Http\Controllers\Form\UserFormController;
use Klein\Klein;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\TwigFunction;


require_once dirname(__DIR__) . "/vendor/autoload.php";
require_once dirname(__DIR__) . "/http/Factory/AuthSocialFactory.php";
require_once dirname(__DIR__) . '/http/Controllers/BotController.php';
require_once dirname(__DIR__) . '/http/Controllers/HomeController.php';
require_once dirname(__DIR__) . '/http/Controllers/UserController.php';
require_once dirname(__DIR__) . '/http/Controllers/Form/UserFormController.php';

$container = new Container();

$app = new Klein();

$entityManager = new EntityManager(
    DriverManager::getConnection([
        'driver' => 'pgsql',
        'dbname' => 'cosmobot_db',
        'user' => 'raptor',
        'password' => 'lama22',
        'host' => '172.18.0.1'
    ]),
    ORMSetup::createAttributeMetadataConfiguration(
        array(dirname(__DIR__) . "/domain/Entities"),
        true
    ));

$view = new Environment(
    new FilesystemLoader([dirname(__DIR__) . "/views"])
);
$view->addFunction(new TwigFunction('load_static', function ($asset) {
    return sprintf('resources/%s', ltrim($asset, '/'));
}));


// DI Containerization's
$container->set(Environment::class, $view);

// Factory
$container->set(AuthSocialTelegram::class, new AuthSocialTelegram());
$container->set(AuthSocialVk::class, new AuthSocialVk());

// Controllers
$container
    ->set(HomeController::class, DI\autowire(HomeController::class)
        ->constructor($container->get(Environment::class)));

$container
    ->set(BotController::class, DI\autowire(BotController::class)
        ->constructor($container->get(Environment::class)));

$container
    ->set(UserController::class, DI\autowire(UserController::class)
        ->constructor($container->get(Environment::class)));

// Request controllers
$container
    ->set(UserFormController::class, DI\autowire(UserFormController::class)
        ->constructor(
            $container->get(AuthSocialTelegram::class),
            $container->get(AuthSocialVk::class)
        ));