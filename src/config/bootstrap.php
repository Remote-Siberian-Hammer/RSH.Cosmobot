<?php

use GuzzleHttp\Client;
use DI\Container;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Http\Factory\SocialTelegramFactory;
use Http\Factory\SocialVkFactory;
use Http\Controllers\BotController;
use Http\Controllers\HomeController;
use Http\Controllers\UserController;
use Http\Controllers\Form\UserFormController;
use Http\Controllers\Form\BotFormController;
use Http\Services\BotService;
use Klein\Klein;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\TwigFunction;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use MongoDB\Client as DoctrineMongoClient;


if ( ! file_exists($file = "../vendor/autoload.php")) {
    throw new RuntimeException('Install dependencies to run this script.');
}

$loader = require_once $file;

// $client = new Client('mongodb://127.0.0.1', [], ['typeMap' => DocumentManager::CLIENT_TYPEMAP]);
$client = new DoctrineMongoClient("mongodb://raptor:lama22@172.18.0.2:27017", ['typeMap' => DocumentManager::CLIENT_TYPEMAP]);


$config = new Configuration();
$config->setProxyDir(__DIR__ . '/Proxies');
$config->setProxyNamespace('Proxies');
$config->setHydratorDir(__DIR__ . '/Hydrators');
$config->setHydratorNamespace('Hydrators');
$config->setDefaultDB('doctrine_odm');
$config->setMetadataDriverImpl(AnnotationDriver::create("../Models"));

$documentManager = DocumentManager::create($client, $config);

require_once dirname(__DIR__) . "/vendor/autoload.php";
require_once dirname(__DIR__) . '/http/Controllers/BotController.php';
require_once dirname(__DIR__) . '/http/Controllers/HomeController.php';
require_once dirname(__DIR__) . '/http/Controllers/UserController.php';
require_once dirname(__DIR__) . '/http/Controllers/Form/UserFormController.php';
require_once dirname(__DIR__) . '/http/Controllers/Form/BotFormController.php';
require_once dirname(__DIR__) . "/http/Factory/AuthSocialFactory.php";
require_once dirname(__DIR__) . '/http/Services/BotService.php';
require_once dirname(__DIR__) . '/Models/Dom.php';
require_once dirname(__DIR__) . '/repository/DomCacheRepository.php';

$http = new Client();
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
$view->addFunction(new TwigFunction('auth', function () {
    return isset($_COOKIE['user_id']) && isset($_COOKIE['user_platform_id']);
}));
$view->addFunction(new TwigFunction('get_cookie', function (string $key) {
    return key_exists($key, $_COOKIE) ? $_COOKIE[$key] : null;
}));

// Http Client
$container->set(Client::class, $http);
// View
$container->set(Environment::class, $view);
// Factory
$container->set(SocialTelegramFactory::class, new SocialTelegramFactory());
$container->set(SocialVkFactory::class, new SocialVkFactory());
// Services
$container->set(BotService::class, DI\autowire(BotService::class)
    ->constructor($container->get(Client::class)));
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
            $container->get(SocialTelegramFactory::class),
            $container->get(SocialVkFactory::class)
        ));
$container
    ->set(BotFormController::class, DI\autowire(BotFormController::class)
        ->constructor($container->get(BotService::class)));